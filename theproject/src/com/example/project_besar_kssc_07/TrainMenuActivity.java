package com.example.project_besar_kssc_07;

import java.io.File;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.List;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
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

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.Canvas;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.os.Message;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.ToggleButton;

public class TrainMenuActivity extends Activity implements
		CvCameraViewListener2 {
	private File mCascadeFile;
	private CascadeClassifier mJavaDetector;
	private CameraRealTime cameraRealTime;
	private static final String TAG = "TrainActivity";
	private String[] mDetectorName;
	public static final int JAVA_DETECTOR = 0;
	public static final int NATIVE_DETECTOR = 1;
	private Button buttonBack;
	private EditText thresholdTrain;
	private int THRESHOLD = 125;
	private ImageView imageTrain;
	Bitmap mBitmap;
	Handler mHandler;
	EditText txtidCitizen, textName, txtBirthDate, txtAddress, txtCrimeHistory;
	int countImages = 0;
	static final long max_image = 1;
	ToggleButton btnRec;
	LinearLayout lyName, lyBirthDate, lyAddress, lyCrime, lyImage;
	Integer idCitizen = 0;
	private int id_citizen = 0;
	private int faceState = IDX_IDLE;
	public static final int IDX_TRAINING = 0;
	public static final int IDX_IDLE = 2;
	List<NameValuePair> params = new ArrayList<NameValuePair>();
	private Mat mRgba;
	private Mat mGray;
	private int mAbsoluteFaceSize = 0;
	private float mRelativeFaceSize = 0.2f;
	private int mDetectorType = JAVA_DETECTOR;
	static final int WIDTH = 128;
	static final int HEIGHT = 128;
	private static final Scalar FACE_DETECT_COLOR = new Scalar(255, 0, 0, 0);
	private static final String TAG_ID_CITIZEN = "id";
	private ProgressDialog pDialog;
//	 private String URL_API = "http://192.168.61.1:81/myktp/api/InsertAllInformation.php";
	private String URL_API = "http://kssc07.bismaoperation.id/api/InsertAllInformation.php";
	JSONParser jsonParser = new JSONParser();
	StoringImage storingImage;

	private String name, nik, gender, placeOfBirth, birthDate, blood, address,
			job, status, state;
	private TextView txtTemp;

	private BaseLoaderCallback mLoaderCallback = new BaseLoaderCallback(this) {
		@Override
		public void onManagerConnected(int status) {
			switch (status) {
			case LoaderCallbackInterface.SUCCESS: {
				Log.i(TAG, "OpenCV loaded successfully");
				try {
					storingImage = new StoringImage();
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

	public TrainMenuActivity() {
		mDetectorName = new String[2];
		mDetectorName[JAVA_DETECTOR] = "Java";
		mDetectorName[NATIVE_DETECTOR] = "Native (tracking)";
		Log.i(TAG, "Instantiated new " + this.getClass());
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		requestWindowFeature(Window.FEATURE_NO_TITLE);
		setContentView(R.layout.train_menu);

		buttonBack = (Button) findViewById(R.id.imageButton2);
		thresholdTrain = (EditText) findViewById(R.id.txtThresholdTrain);
		thresholdTrain.setText(String.valueOf(THRESHOLD));
		thresholdTrain.addTextChangedListener(new TextWatcher() {
			public void afterTextChanged(Editable s) {
				if (s.length() == 0) {
					thresholdTrain.setText("0");
				} else {
					if (Integer.parseInt(s.toString()) < 0) {
						thresholdTrain.setText("0");
					} else if (Integer.parseInt(s.toString()) > 255) {
						thresholdTrain.setText("255");
					}
				}
			}

			public void beforeTextChanged(CharSequence s, int start, int count,
					int after) {
			}

			public void onTextChanged(CharSequence s, int start, int before,
					int count) {
			}
		});
		buttonBack.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				finish();
				Intent i = new Intent(getApplicationContext(),
						MainMenuActivity.class);
				startActivity(i);
			}
		});
		cameraRealTime = (CameraRealTime) findViewById(R.id.cameraRealTime1);
		cameraRealTime.setCvCameraViewListener(this);
		final Bundle bundle = getIntent().getExtras(); // To GET Bundle
		imageTrain = (ImageView) findViewById(R.id.imageView1);
		mHandler = new Handler() {
			@Override
			public void handleMessage(Message msg) {
				if (msg.obj == "IMG") {
					Canvas canvas = new Canvas();
					canvas.setBitmap(mBitmap);
					imageTrain.setImageBitmap(mBitmap);
					if (countImages >= max_image - 1) {
						btnRec.setChecked(false);
						grabarOnclick();
					}
				}
			}
		};

		txtTemp = (TextView) findViewById(R.id.txtTemp);
		txtTemp.setVisibility(View.GONE);
		// txtTemp.setText(bundle.getString("name"));

		txtidCitizen = (EditText) findViewById(R.id.txtidCitizen);
		btnRec = (ToggleButton) findViewById(R.id.toggleButtonGrabar);
		lyName = (LinearLayout) findViewById(R.id.layoutName);
		lyAddress = (LinearLayout) findViewById(R.id.layoutAddress);
		lyBirthDate = (LinearLayout) findViewById(R.id.layoutBirthDate);
		lyCrime = (LinearLayout) findViewById(R.id.layoutCrimeHistory);
		lyImage = (LinearLayout) findViewById(R.id.layoutImage);
		btnRec.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				btnRec.setChecked(true);
				grabarOnclick();
			}
		});
		idCitizen = bundle.getInt("idCitizen");
		name = bundle.getString("name");
		nik = bundle.getString("nik");
		gender = bundle.getString("gender");
		placeOfBirth = bundle.getString("placeOfBirth");
		birthDate = bundle.getString("birthDate");
		blood = bundle.getString("blood");
		address = bundle.getString("address");
		job = bundle.getString("job");
		status = bundle.getString("status");
		state = bundle.getString("state");

		if (idCitizen != null) {
			if (idCitizen != 0) {
				lyName.setVisibility(View.GONE);
				lyAddress.setVisibility(View.GONE);
				lyBirthDate.setVisibility(View.GONE);
				lyCrime.setVisibility(View.GONE);
				lyImage.setVisibility(View.VISIBLE);
				// txtidCitizen.setText(idCitizen);
			} else {
				lyName.setVisibility(View.VISIBLE);
				lyAddress.setVisibility(View.VISIBLE);
				lyBirthDate.setVisibility(View.VISIBLE);
				lyCrime.setVisibility(View.VISIBLE);
				lyImage.setVisibility(View.GONE);
			}
		}
	}

	void grabarOnclick() {
		if (idCitizen != 0 || (!name.equalsIgnoreCase(""))) {
			if (btnRec.isChecked()) {
				if (idCitizen != null) {
					if (idCitizen != 0) {
						countImages = 0;
						id_citizen = idCitizen;
						faceState = IDX_TRAINING;
						String sStart = getResources().getString(
								R.string.STStartTrain);
						Toast.makeText(getApplicationContext(), sStart,
								Toast.LENGTH_LONG).show();
					} else {
						countImages = 0;
						params = new ArrayList<NameValuePair>();
						/*
						 * String birthDate = "1990-07-10"; String address =
						 * "tes eclipse 3"; String caseHistory = "-";
						 */
						params.add(new BasicNameValuePair("name", name));
						params.add(new BasicNameValuePair("nik", nik));
						params.add(new BasicNameValuePair("gender", gender));
						params.add(new BasicNameValuePair("placeOfBirth",
								placeOfBirth));
						params.add(new BasicNameValuePair("birthDate",
								birthDate));
						params.add(new BasicNameValuePair("blood", blood));
						params.add(new BasicNameValuePair("address", address));
						params.add(new BasicNameValuePair("job", job));
						params.add(new BasicNameValuePair("status", status));
						params.add(new BasicNameValuePair("state", state));
						new InsertToDatabase().execute();
					}
				}
			} else {
				if (faceState == IDX_TRAINING) {
					String sFinish = getResources().getString(
							R.string.STStopTtrain);
					countImages = 0;
					// faceState = IDX_IDLE;
					Toast.makeText(getApplicationContext(), sFinish,
							Toast.LENGTH_LONG).show();
				}
			}
		} else {
			btnRec.setChecked(false);
			if (btnRec.isChecked()) {
				String sWarning = getResources().getString(
						R.string.STWarningEmptyInformation);
				Toast.makeText(getApplicationContext(), sWarning,
						Toast.LENGTH_LONG).show();
			}
		}
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
						2, // TODO: objdetect.CV_HAAR_SCALE_IMAGE
						new Size(mAbsoluteFaceSize, mAbsoluteFaceSize),
						new Size());
		} else if (mDetectorType == NATIVE_DETECTOR) {
		} else {
			Log.e(TAG, "Detection method is not selected!");
		}
		Rect[] facesArray = faces.toArray();
		if ((facesArray.length == 1) && (faceState == IDX_TRAINING)
				&& (countImages < max_image) && (id_citizen != 0)) {
			Mat m = new Mat();
			m = mRgba.submat(facesArray[0]);
			mBitmap = Bitmap.createBitmap(m.width(), m.height(),
					Bitmap.Config.ARGB_8888);
			Utils.matToBitmap(m, mBitmap);
			mBitmap = Bitmap.createScaledBitmap(mBitmap, WIDTH, HEIGHT, false);
			AndroidImage aiColor = new AndroidImage(mBitmap);
			int[][] mtxLuminance = ThresholdingFilter
					.ProccessLuminance(aiColor);
			Bitmap LumImg = ThresholdingFilter.ConvertToImage(mtxLuminance);
			// mBitmap = LumImg;
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
			if (countImages < max_image) {
				storingImage.addWithWebService(m, id_citizen);
				// faceRecognition.add(m,
				// textName.getText().toString(),textDetails.getText().toString());
				countImages++;
				Intent i = new Intent(this, MainMenuActivity.class);
				startActivity(i);
			}
		}
		for (int i = 0; i < facesArray.length; i++) {
			Core.rectangle(mRgba, facesArray[i].tl(), facesArray[i].br(),
					FACE_DETECT_COLOR, 3);
			if (facesArray.length == 1 && faceState != IDX_TRAINING) {
				Mat m = new Mat();
				m = mRgba.submat(facesArray[0]);
				mBitmap = Bitmap.createBitmap(m.width(), m.height(),
						Bitmap.Config.ARGB_8888);
				Utils.matToBitmap(m, mBitmap);
				mBitmap = Bitmap.createScaledBitmap(mBitmap, WIDTH, HEIGHT,
						false);
				AndroidImage aiColor = new AndroidImage(mBitmap);
				int[][] mtxLuminance = ThresholdingFilter
						.ProccessLuminance(aiColor);
				Bitmap LumImg = ThresholdingFilter.ConvertToImage(mtxLuminance);
				mBitmap = LumImg;
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
			}
		}
		return mRgba;
	}

	/**
	 * Background Async Task to Create new product
	 * */
	class InsertToDatabase extends AsyncTask<String, String, String> {
		/**
		 * Before starting background thread Show Progress Dialog
		 * */
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
			pDialog = new ProgressDialog(TrainMenuActivity.this);
			pDialog.setMessage("Saving Data...");
			pDialog.setIndeterminate(false);
			pDialog.setCancelable(true);
			pDialog.show();
		}

		/**
		 * Creating product
		 * */
		protected String doInBackground(String... args) {
			// getting JSON Object
			// Note that create product url accepts POST method
			JSONObject json = jsonParser.makeHttpRequest(URL_API, "POST",
					params);
			// Toast.makeText(getApplicationContext(),json.toString(),
			// Toast.LENGTH_LONG).show();
			// check log cat fro responseLog.d("Create Response",
			// json.toString());
			try {
				id_citizen = json.getInt(TAG_ID_CITIZEN);
			} catch (JSONException e) {
				e.printStackTrace();
				id_citizen = 0;
			}
			return "" + id_citizen;
		}

		/**
		 * After completing background task Dismiss the progress dialog
		 * **/
		protected void onPostExecute(String file_url) {
			// dismiss the dialog once done
			pDialog.dismiss();
			if (id_citizen == 0) {
				Toast.makeText(getApplicationContext(), "Insert Data Failed",
						Toast.LENGTH_LONG).show();
			} else {
				String sStart = getResources().getString(R.string.STStartTrain);
				Toast.makeText(getApplicationContext(), sStart,
						Toast.LENGTH_LONG).show();
				faceState = IDX_TRAINING;
				btnRec.setChecked(false);
			}
		}
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
