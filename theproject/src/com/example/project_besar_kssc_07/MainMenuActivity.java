package com.example.project_besar_kssc_07;

import java.io.File;
import java.util.ArrayList;
import java.util.HashMap;
import org.json.JSONArray;

import com.example.project_besar_kssc_07.R;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.os.Environment;
import android.util.Log;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.Toast;

public class MainMenuActivity extends Activity {
	private static final String TAG = "OCVSample::MainMenuActivity";
	private Button btnExit, btnTrain, btnSearch;

	public MainMenuActivity() {
		Log.i(TAG, "Instantiated new " + this.getClass());
	}

	@Override
	public void onCreate(Bundle savedInstanceState) {
		Log.i(TAG, "called onCreate");
		super.onCreate(savedInstanceState);
		getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);

		setContentView(R.layout.main_menu);
		btnExit = (Button) findViewById(R.id.buttonMMExit);
		btnTrain = (Button) findViewById(R.id.buttonMMTrain);
		btnSearch = (Button) findViewById(R.id.buttonMMSearch);
		btnExit.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				finish();
			}
		});

		btnSearch.setOnClickListener(new View.OnClickListener() {
			public void onClick(View view) {
				Intent i = new Intent(MainMenuActivity.this,
						SearchMenuActivity.class);
				startActivity(i);
			};
		});

		btnTrain.setOnClickListener(new View.OnClickListener() {
			public void onClick(View view) {
				Intent i = new Intent(MainMenuActivity.this,
						TrainSubMenuActivity.class);
				startActivity(i);
			};
		});

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
