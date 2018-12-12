package com.example.project_besar_kssc_07;

import java.util.ArrayList;
import java.util.List;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;
import org.opencv.android.Utils;
import org.opencv.core.Mat;

import android.content.Intent;
import android.graphics.Bitmap;
import android.os.AsyncTask;
import android.util.Log;
import com.google.gson.Gson;
import com.example.project_besar_kssc_07.ThresholdingFilter; //Sesuaikan dengan package kalian

public class StoringImage {
	int WIDTH = 128;
	int HEIGHT = 128;
	private int DECOMPOSITION_SIZE = 64;
	List<NameValuePair> params = new ArrayList<NameValuePair>();
	JSONParser jsonParser = new JSONParser();
	private static final String TAG_SUCCESS = "success";
//	private String URL_API_DETAIL = "http://192.168.61.1:81/myktp/api/InsertDetailInformation.php";
	private String URL_API_DETAIL = "http://kssc07.bismaoperation.id/api/InsertDetailInformation.php";

	StoringImage() {
	}

	void addWithWebService(Mat m, int idCitizen) {
		Bitmap bmp = Bitmap.createBitmap(m.width(), m.height(),
				Bitmap.Config.ARGB_8888);
		Utils.matToBitmap(m, bmp);
		bmp = Bitmap.createScaledBitmap(bmp, WIDTH, HEIGHT, false);
		AndroidImage aiResult = new AndroidImage(bmp);

		int[][] mtxWav = ThresholdingFilter.WaveletHaar2D(aiResult,
				DECOMPOSITION_SIZE); // bitmap dr pictBox dilakukan trans
										// wavelet haar
		Bitmap bmpW = ThresholdingFilter.drawWaveletBmp(mtxWav,
				DECOMPOSITION_SIZE);
		WIDTH = bmpW.getWidth();
		HEIGHT = bmpW.getHeight();

		int[] matriksLinear = new int[WIDTH * HEIGHT];
		// Convert to matrix linear
		AndroidImage AIbmp = new AndroidImage(bmpW);
		matriksLinear = ThresholdingFilter.convertMatriksLinear(AIbmp);

		Gson gson = new Gson();
		String jsonmMatriksLinear = gson.toJson(matriksLinear);

		// Building Parameters
		params = new ArrayList<NameValuePair>();
		params.add(new BasicNameValuePair("idCitizen", String
				.valueOf(idCitizen)));
		params.add(new BasicNameValuePair("matrixLinearImage",
				jsonmMatriksLinear));
		params.add(new BasicNameValuePair("eigenVector", ""));
		params.add(new BasicNameValuePair("meanFlatVector", ""));

		new InsertToDatabase().execute();

	}

	class InsertToDatabase extends AsyncTask<String, String, String> {
		/**
		 * Before starting background thread Show Progress Dialog
		 * */
		@Override
		protected void onPreExecute() {
			super.onPreExecute();
		}

		/**
		 * Creating product
		 * */
		protected String doInBackground(String... args) {
			int success = 0;

			// getting JSON Object
			// Note that create product url accepts POST method
			JSONObject json = jsonParser.makeHttpRequest(URL_API_DETAIL,
					"POST", params);
			// check log cat fro response
			Log.d("Create Response", json.toString());
			try {
				success = json.getInt(TAG_SUCCESS);
			} catch (JSONException e) {
				e.printStackTrace();
				success = 0;
			}
			return "" + success;
		}

		private void startActivity(Intent i) {
			// TODO Auto-generated method stub
			
		}

		/**
		 * After completing background task Dismiss the progress dialog
		 * **/
		protected void onPostExecute(String file_url) {
		}
	}

}
