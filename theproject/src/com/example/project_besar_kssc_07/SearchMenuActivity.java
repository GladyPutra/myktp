package com.example.project_besar_kssc_07;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.opencv.android.BaseLoaderCallback;
import org.opencv.android.LoaderCallbackInterface;
import org.opencv.android.OpenCVLoader;
import org.opencv.android.Utils;
import org.opencv.android.CameraBridgeViewBase.CvCameraViewFrame;
import org.opencv.android.CameraBridgeViewBase.CvCameraViewListener2;
import org.opencv.core.Core;
import org.opencv.core.Mat;
import org.opencv.core.MatOfRect;
import org.opencv.core.Rect;
import org.opencv.core.Scalar;
import org.opencv.core.Size;
import org.opencv.imgproc.Imgproc;
import org.opencv.objdetect.CascadeClassifier;

import com.example.project_besar_kssc_07.R;
import com.google.gson.Gson;
import com.googlecode.javacpp.Parser;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.res.Configuration;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.media.ExifInterface;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.os.Handler;
import android.os.Message;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

public class SearchMenuActivity extends Activity implements
		CvCameraViewListener2 {
	private String[] mDetectorName;
	public static final int JAVA_DETECTOR = 0;
	public static final int NATIVE_DETECTOR = 1;
	private static final String TAG = "SearchActivity";
	private static final Scalar FACE_RECT_COLOR = new Scalar(255, 0, 0, 0);
	ToggleButton buttonSearch;
	private Button buttonBack;
	private int THRESHOLD = 125;
	private EditText thresholdSearch;
	private CameraRealTime cameraRealTime;
	long init, now, times = 0;
	public static final int IDX_TRAINING = 0;
	public static final int IDX_SEARCHING = 1;
	public static final int IDX_IDLE = 2;
	String temp = "";
	private int faceState = IDX_IDLE;
	private File mCascadeFile;
	private CascadeClassifier mJavaDetector;
	private int mDetectorType = JAVA_DETECTOR;
	private ProgressDialog pDialog;
	private Mat mRgba;
	private Mat mGray;
	private float mRelativeFaceSize = 0.2f;
	private int mAbsoluteFaceSize = 0;
	static final long max_image = 3;
	int countImages = 0;
	int WIDTH = 128;
	int HEIGHT = 128;
	Bitmap mBitmap;
	private ImageView img_search;
	Handler mHandler;

	TextView textresult, textLikely, textTime;
	private double distance = 0;
	String txtOri;
	private int time_counter = 45;
	private Timer timer;
	JSONParser jsonParser = new JSONParser();
//	private String URL_RECOGNIZE = "http://192.168.61.1:81/myktp/api/RecognizeInPHP.php";
	 private String URL_RECOGNIZE =
	 "http://kssc07.bismaoperation.id/api/RecognizeInPHP.php";
	List<NameValuePair> params = new ArrayList<NameValuePair>();
	private String fullname, nik, gender, placeOfBirth, birthDate, typeBlood,
			address, job, status, state, matrix_result_recogn;
	private int DECOMPOSITION_SIZE = 64;
	String jsonMatriksLinear = "";

	private BaseLoaderCallback mLoaderCallback = new BaseLoaderCallback(this) {
		@Override
		public void onManagerConnected(int status) {
			switch (status) {
			case LoaderCallbackInterface.SUCCESS: {
				Log.i(TAG, "OpenCV loaded successfully");
				try {
					InputStream is = getResources().openRawResource(
							R.raw.lbpcascade_frontalface);
					File cascadeDir = getDir("cascade", Context.MODE_PRIVATE);
					mCascadeFile = new File(cascadeDir, "lbpcascade.xml");
					FileOutputStream os = new FileOutputStream(mCascadeFile);
					byte[] buffer = new byte[4096];
					int bytesRead;
					while ((bytesRead = is.read(buffer)) != -1) {
						os.write(buffer, 0, bytesRead);
					}
					is.close();
					os.close();
					mJavaDetector = new CascadeClassifier(
							mCascadeFile.getAbsolutePath());
					if (mJavaDetector.empty()) {
						Log.e(TAG, "Failed to load cascade classifier");
						mJavaDetector = null;
					} else
						Log.i(TAG, "Loaded cascade classifier from "
								+ mCascadeFile.getAbsolutePath());
					cascadeDir.delete();
				} catch (IOException e) {
					e.printStackTrace();
					Log.e(TAG, "Failed to load cascade. Exception thrown: " + e);
				}
				cameraRealTime.enableView();
			}
				break;
			default: {
				super.onManagerConnected(status);
			}
				break;
			}
		}
	};

	public SearchMenuActivity() {
		mDetectorName = new String[2];
		mDetectorName[JAVA_DETECTOR] = "Java";
		mDetectorName[NATIVE_DETECTOR] = "Native (tracking)";
		Log.i(TAG, "Instantiated new " + this.getClass());
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		Log.i(TAG, "called onCreate");
		super.onCreate(savedInstanceState);
		getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);
		setContentView(R.layout.search_main);

		ActionBar menu = getActionBar();
		menu.setDisplayShowHomeEnabled(true);
		menu.setDisplayHomeAsUpEnabled(true);

		buttonBack = (Button) findViewById(R.id.buttonDetail);
		img_search = (ImageView) findViewById(R.id.imageView1);

		textresult = (TextView) findViewById(R.id.textBestResult);
		textLikely = (TextView) findViewById(R.id.textResultLikely);
		textTime = (TextView) findViewById(R.id.txtTimeRecognition);

		thresholdSearch = (EditText) findViewById(R.id.txtThresholdSearch);
		thresholdSearch.setText(String.valueOf(THRESHOLD));
		thresholdSearch.addTextChangedListener(new TextWatcher() {
			public void afterTextChanged(Editable s) {
				if (s.length() == 0) {
					thresholdSearch.setText("0");
				} else {
					if (Integer.parseInt(s.toString()) < 0) {
						thresholdSearch.setText("0");
					} else if (Integer.parseInt(s.toString()) > 255) {
						thresholdSearch.setText("255");
					}
				}
			}

			public void beforeTextChanged(CharSequence s, int start, int count,
					int after) {
			}

			public void onTextChanged(CharSequence s, int start, int before,
					int count) {
				if (s.length() == 0) {
					thresholdSearch.setText("0");
				} else {
					if (Integer.parseInt(s.toString()) < 0) {
						thresholdSearch.setText("0");
					} else if (Integer.parseInt(s.toString()) > 255) {
						thresholdSearch.setText("255");
					}
				}
				THRESHOLD = Integer.parseInt(thresholdSearch.getText()
						.toString());
			}
		});
		buttonBack.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				// finish();
				if (textresult.length() == 0) {
					Toast.makeText(getApplicationContext(),
							"Not Found Detail...!", Toast.LENGTH_LONG).show();
				} else {
					Intent i = new Intent(SearchMenuActivity.this,
							DetailTrainActivity.class);
					Bundle dataCitizen = new Bundle();

					dataCitizen.putString("fullname", fullname);
					dataCitizen.putString("nik", nik);
					dataCitizen.putString("gender", gender);
					dataCitizen.putString("placeOfBirth", placeOfBirth);
					dataCitizen.putString("birthDate", birthDate);
					dataCitizen.putString("address", address);
					dataCitizen.putString("job", job);
					dataCitizen.putString("status", status);
					dataCitizen.putString("blood", typeBlood);
					dataCitizen.putString("state", state);
					dataCitizen.putString("distance", String.valueOf(distance));
					dataCitizen.putString("matrix", matrix_result_recogn);

					i.putExtras(dataCitizen);
					startActivity(i);
				}
			}
		});
		mHandler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				if (msg.obj == "IMG") {
					Canvas canvas = new Canvas();
					canvas.setBitmap(mBitmap);
					img_search.setImageBitmap(mBitmap);
				} else {
					txtOri = msg.obj.toString();
					String description = "";
					if (msg.obj.toString().contains("_")) {
						int i4 = msg.obj.toString().lastIndexOf("_");
						description = msg.obj.toString().substring(0, i4);
					} else {
						description = msg.obj.toString();
					}

					textresult.setText(description);
					textLikely.setText(String.valueOf(distance));
					temp = temp + "*" + description + "_"
							+ String.valueOf(distance) + "_"
							+ String.valueOf(times);
					textTime.setText(String.valueOf(times));
				}
			}
		};
		cameraRealTime = (CameraRealTime) findViewById(R.id.cameraRealTime1);
		cameraRealTime.setCvCameraViewListener(this);
		buttonSearch = (ToggleButton) findViewById(R.id.buttonSearch);
		buttonSearch.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				if (buttonSearch.isChecked()) {
					times = 0;
					init = System.currentTimeMillis();

					textresult.setText("Searching...");
					textLikely.setText("Searching...");
					textTime.setText("Searching...");

					temp = "";
					faceState = IDX_SEARCHING;
				} else {
					faceState = IDX_IDLE;
					// txtLinkDetails.setText(temp);
				}
			}
		});
	}

	@Override
	public void onPause() {
		super.onPause();
		if (cameraRealTime != null)
			cameraRealTime.disableView();
	}

	@Override
	public void onResume() {
		super.onResume();
		OpenCVLoader.initAsync(OpenCVLoader.OPENCV_VERSION_2_4_3, this,
				mLoaderCallback);
	}

	public void onDestroy() {
		super.onDestroy();
		cameraRealTime.disableView();
	}

	public void onCameraViewStarted(int width, int height) {
		mGray = new Mat();
		mRgba = new Mat();
	}

	public void onCameraViewStopped() {
		mGray.release();
		mRgba.release();
	}

	public Mat onCameraFrame(CvCameraViewFrame inputFrame) {
		mRgba = inputFrame.rgba();
		mGray = inputFrame.gray();
		Mat mRgbaT = mRgba.t();
		Core.flip(mRgba.t(), mRgbaT, 1);
		Imgproc.resize(mRgbaT, mRgbaT, mRgba.size());
		Mat mGrayT = mGray.t();
		Core.flip(mGray.t(), mGrayT, 1);
		Imgproc.resize(mGrayT, mGrayT, mGray.size());
		mRgba = mRgbaT;
		mGray = mGrayT;
		if (mAbsoluteFaceSize == 0) {
			int height = mGray.rows();
			if (Math.round(height * mRelativeFaceSize) > 0) {
				mAbsoluteFaceSize = Math.round(height * mRelativeFaceSize);
			}
		}
		MatOfRect faces = new MatOfRect();
		if (mDetectorType == JAVA_DETECTOR) {
			if (mJavaDetector != null)
				mJavaDetector.detectMultiScale(mGray, faces, 1.1, 2,
						2, // TODO objdetect.CV_HAAR_SCALE_IMAGE
						new Size(mAbsoluteFaceSize, mAbsoluteFaceSize),
						new Size());
		} else if (mDetectorType == NATIVE_DETECTOR) {
		} else {
			Log.e(TAG, "Detection method is not selected!");
		}
		Rect[] facesArray = faces.toArray();
		if ((facesArray.length == 1) && (faceState == IDX_TRAINING)
				&& (countImages < max_image)) {
		} else if ((facesArray.length > 0) && (faceState == IDX_SEARCHING)) {
			// startCountDown();
			Mat m = new Mat();
			m = mGray.submat(facesArray[0]);
			mBitmap = Bitmap.createBitmap(m.width(), m.height(),
					Bitmap.Config.ARGB_8888);
			Utils.matToBitmap(m, mBitmap);
			mBitmap = Bitmap.createScaledBitmap(mBitmap, WIDTH, HEIGHT, false);
			AndroidImage aiColor = new AndroidImage(mBitmap);
			int[][] mtxLuminance = ThresholdingFilter
					.ProccessLuminance(aiColor);
			Bitmap LumImg = ThresholdingFilter.ConvertToImage(mtxLuminance);
			Utils.bitmapToMat(LumImg, m);
			Imgproc.cvtColor(m, m, Imgproc.COLOR_RGB2GRAY);
			Mat dst = new Mat();
			Imgproc.equalizeHist(m, dst);
			m = dst;
			Utils.matToBitmap(m, mBitmap);
			Message msg = new Message();
			String textTochange = "IMG";
			msg.obj = textTochange;
			mHandler.sendMessage(msg);
			RecognizeInPHP(m);
		}
		for (int i = 0; i < facesArray.length; i++) {
			Core.rectangle(mRgba, facesArray[i].tl(), facesArray[i].br(),
					FACE_RECT_COLOR, 3);
			if (facesArray.length == 1 && faceState != IDX_SEARCHING) {
				Mat m = new Mat();
				m = mGray.submat(facesArray[0]);
				mBitmap = Bitmap.createBitmap(m.width(), m.height(),
						Bitmap.Config.ARGB_8888);
				Utils.matToBitmap(m, mBitmap);
				mBitmap = Bitmap.createScaledBitmap(mBitmap, WIDTH, HEIGHT,
						false);
				AndroidImage aiColor = new AndroidImage(mBitmap);
				int[][] mtxLuminance = ThresholdingFilter
						.ProccessLuminance(aiColor);
				Bitmap LumImg = ThresholdingFilter.ConvertToImage(mtxLuminance);
				Utils.bitmapToMat(LumImg, m);
				Imgproc.cvtColor(m, m, Imgproc.COLOR_RGB2GRAY);
				Mat dst = new Mat();
				Imgproc.equalizeHist(m, dst);
				m = dst;
				Utils.matToBitmap(m, mBitmap);
				Message msg = new Message();
				String textTochange = "IMG";
				msg.obj = textTochange;
				// mHandler.sendMessage(msg);
			}
		}
		return mRgba;
	}

	public void startCountDown() {
		timer = new Timer();
		timer.schedule(new TimerTask() {
			public void run() {
				time_counter++;
			}
		}, 0, 1000);
	}

	class RecognizeToDatabase extends AsyncTask<String, String, String> {
		protected void onPreExecute() {
			super.onPreExecute();
		}

		protected String doInBackground(String... args) {
			faceState = IDX_IDLE;
			JSONObject jsonRecognize = new JSONObject();
			jsonRecognize = JSONParser.makeHttpRequest(URL_RECOGNIZE, "POST",
					params);
			Log.d("create Response", jsonRecognize.toString());
			try {
				JSONArray jArray = jsonRecognize.getJSONArray("Recognize");
				JSONObject json_data = jArray.getJSONObject(0);

				fullname = json_data.getString("fullname");
				nik = json_data.getString("nik");
				gender = json_data.getString("gender");
				placeOfBirth = json_data.getString("place_of_birth");
				birthDate = json_data.getString("birth_date");
				typeBlood = json_data.getString("type_blood");
				address = json_data.getString("address");
				job = json_data.getString("job");
				status = json_data.getString("status");
				state = json_data.getString("state");
				distance = json_data.getDouble("distance");
				matrix_result_recogn = json_data
						.getString("matrix_linear_image");

			} catch (JSONException e) {
				e.printStackTrace();
				fullname = "";
				nik = "";
				gender = "";
				placeOfBirth = "";
				birthDate = "";
				typeBlood = "";
				address = "";
				job = "";
				status = "";
				state = "";
				matrix_result_recogn = "";
			}
			return "";
		}

		protected void onPostExecute(String file_url) {
			String textTochange = "";
			textTochange = fullname;
			now = System.currentTimeMillis();
			times = now - init;
			Message msg = new Message();
			msg.obj = textTochange;
			mHandler.sendMessage(msg);
			buttonSearch.setChecked(false);
		}
	}

	void RecognizeInPHP(Mat m) {
		Bitmap bmp = Bitmap.createBitmap(m.width(), m.height(),
				Bitmap.Config.ARGB_8888);

		Utils.matToBitmap(m, bmp);
		bmp = Bitmap.createScaledBitmap(bmp, WIDTH, HEIGHT, false);

		AndroidImage aiResult = new AndroidImage(bmp);

		int[][] mtxWav = ThresholdingFilter.WaveletHaar2D(aiResult,
				DECOMPOSITION_SIZE);

		Bitmap bmpW = ThresholdingFilter.drawWaveletBmp(mtxWav,
				DECOMPOSITION_SIZE);

		WIDTH = bmpW.getWidth();
		HEIGHT = bmpW.getHeight();

		int[] matriksLinear = new int[WIDTH * HEIGHT];

		AndroidImage AIbmp = new AndroidImage(bmpW);
		matriksLinear = ThresholdingFilter.convertMatriksLinear(AIbmp);

		Gson gson = new Gson();
		jsonMatriksLinear = gson.toJson(matriksLinear);

		params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("matrixLinearImage",
				jsonMatriksLinear));

		new RecognizeToDatabase().execute();
	}

	@Override
	public void onBackPressed() {
		AlertDialog.Builder builder = new AlertDialog.Builder(this);
		// pesan keluar
		builder.setMessage("Are You Exit This Application?")
				.setCancelable(false)
				// Button Keluar
				.setPositiveButton("Yes",
						new DialogInterface.OnClickListener() {
							public void onClick(DialogInterface dialog, int id) {
								finish();
								moveTaskToBack(true);
								System.exit(0);
							}
						})
				// Button Batal
				.setNegativeButton("No", new DialogInterface.OnClickListener() {
					public void onClick(DialogInterface dialog, int id) {
						dialog.cancel();
					}
				});
		AlertDialog alert = builder.create();
		alert.show();
	}
}