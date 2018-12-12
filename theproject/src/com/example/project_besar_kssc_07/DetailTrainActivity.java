package com.example.project_besar_kssc_07;

import org.json.JSONArray;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.TextView;
import android.widget.Toast;

public class DetailTrainActivity extends Activity {
	Button btnFinish;
	TextView fullname, nik, gender, placeOfBirth, birthDate, blood, address, job, status, state, distance, matrix;
	
	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);
		setContentView(R.layout.detail_train);

		ActionBar menu = getActionBar();
		menu.setDisplayShowHomeEnabled(true);
		menu.setDisplayHomeAsUpEnabled(true);

		Bundle bundle = getIntent().getExtras(); // To GET Bundle
		fullname = (TextView) findViewById(R.id.edfullname);
		nik = (TextView) findViewById(R.id.ednik);
		gender = (TextView) findViewById(R.id.edGender);
		placeOfBirth = (TextView) findViewById(R.id.edPlace);
		birthDate = (TextView) findViewById(R.id.edBirthDate);
		address = (TextView) findViewById(R.id.edAddress);
		blood = (TextView) findViewById(R.id.edBlood);
		job = (TextView) findViewById(R.id.edJob);
		status = (TextView) findViewById(R.id.edStatus);
		state = (TextView) findViewById(R.id.edState);
		distance = (TextView) findViewById(R.id.edDistance);
		matrix = (TextView) findViewById(R.id.edMatrix);
		
		fullname.setText(bundle.getString("fullname"));
		nik.setText(bundle.getString("nik"));
		gender.setText(bundle.getString("gender"));
		placeOfBirth.setText(bundle.getString("placeOfBirth"));
		birthDate.setText(bundle.getString("birthDate"));
		address.setText(bundle.getString("address"));
		blood.setText(bundle.getString("blood"));
		job.setText(bundle.getString("job"));
		status.setText(bundle.getString("status"));
		state.setText(bundle.getString("state"));
		distance.setText(bundle.getString("distance"));
//		matrix.setText(bundle.getString("matrix"));
		
		btnFinish = (Button) findViewById(R.id.btnFinish);
		btnFinish.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View view) {
				finish();
				Intent i = new Intent(DetailTrainActivity.this,
						MainMenuActivity.class);
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
