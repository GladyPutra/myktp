package com.example.project_besar_kssc_07;

import java.security.PublicKey;

import com.example.project_besar_kssc_07.R;

import android.app.ActionBar;
import android.app.Activity;
import android.app.AlertDialog;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.app.ActivityCompat;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

public class TrainSubMenuActivity extends Activity {
	Button btnNext, btnBack;
	EditText name, nik, placeOfBirth, birthDate, address, job;
	RadioButton bloodA, bloodB, bloodAB, bloodO, statusK, statusBK, stateWNI,
			stateWNA, rdMale, rdFemale;
	String typeBlood, state, status, gender;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		getWindow().addFlags(WindowManager.LayoutParams.FLAG_KEEP_SCREEN_ON);
		setContentView(R.layout.train_sub_menu);

		ActionBar menu = getActionBar();
		menu.setDisplayShowHomeEnabled(true);
		menu.setDisplayHomeAsUpEnabled(true);

		name = (EditText) findViewById(R.id.edfullname);
		nik = (EditText) findViewById(R.id.ednik);
		placeOfBirth = (EditText) findViewById(R.id.edPlace);
		birthDate = (EditText) findViewById(R.id.edBirthDate);
		address = (EditText) findViewById(R.id.edAddress);
		job = (EditText) findViewById(R.id.edJob);
		rdMale = (RadioButton) findViewById(R.id.rdMale);
		rdFemale = (RadioButton) findViewById(R.id.rdFemale);
		bloodA = (RadioButton) findViewById(R.id.rdA);
		bloodB = (RadioButton) findViewById(R.id.rdB);
		bloodAB = (RadioButton) findViewById(R.id.rdAB);
		bloodO = (RadioButton) findViewById(R.id.rdO);
		statusK = (RadioButton) findViewById(R.id.rdKawin);
		statusBK = (RadioButton) findViewById(R.id.rdBelumKawin);
		stateWNI = (RadioButton) findViewById(R.id.rdWNI);
		stateWNA = (RadioButton) findViewById(R.id.rdWNA);

		btnNext = (Button) findViewById(R.id.btnNext);
		btnNext.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View view) {
				// Get Type of Citizen's Gender
				if (rdMale.isChecked())
					gender = rdMale.getText().toString();
				else if (rdFemale.isChecked())
					gender = rdFemale.getText().toString();
				else gender = "";

				// Get Type of Citizen's Blood
				if (bloodA.isChecked())
					typeBlood = bloodA.getText().toString();
				else if (bloodB.isChecked())
					typeBlood = bloodB.getText().toString();
				else if (bloodAB.isChecked())
					typeBlood = bloodAB.getText().toString();
				else if (bloodO.isChecked())
					typeBlood = bloodO.getText().toString();
				else
					typeBlood = "-";

				// Get Type of Citizen's State
				if (statusK.isChecked())
					status = statusK.getText().toString();
				else if (statusBK.isChecked())
					status = statusBK.getText().toString();

				// Get Type of Citizen's State
				if (stateWNI.isChecked())
					state = stateWNI.getText().toString();
				else if (stateWNA.isChecked())
					state = stateWNA.getText().toString();
				else
					state = "-";

				// Check Validation Inputing
				if (check_empty(name.getText().toString(), nik.getText()
						.toString(), gender, placeOfBirth.getText().toString(),
						birthDate.getText().toString(), address.getText()
								.toString(), job.getText().toString(), status,
						state) == false) {

					Toast.makeText(getApplicationContext(),
							"Input Can't Empty...!", Toast.LENGTH_LONG).show();

				} else {
					Intent i = new Intent(TrainSubMenuActivity.this,
							TrainMenuActivity.class);
					Bundle dataCitizen = new Bundle();

					dataCitizen.putString("name", name.getText().toString());
					dataCitizen.putString("nik", nik.getText().toString());
					dataCitizen.putString("gender", gender);
					dataCitizen.putString("placeOfBirth", placeOfBirth
							.getText().toString());
					dataCitizen.putString("birthDate", birthDate.getText()
							.toString());
					dataCitizen.putString("address", address.getText()
							.toString());
					dataCitizen.putString("job", job.getText().toString());
					dataCitizen.putString("status", status);
					dataCitizen.putString("blood", typeBlood);
					dataCitizen.putString("state", state);

					i.putExtras(dataCitizen);
					startActivity(i);
				}
			};
		});

	}

	private boolean check_empty(String name, String nik, String gender, String placeOfBirth,
			String birthDate, String address, String job, String status,
			String state) {

		if (name.length() == 0 || nik.length() == 0 || gender.length() == 0
				|| placeOfBirth.length() == 0 || birthDate.length() == 0
				|| address.length() == 0 || job.length() == 0
				|| status.length() == 0 || state.length() == 0) {
			return false;
		}

		return true;
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
