package com.example.pray_project;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.widget.TextView;

public class meritPoint extends prayList {
    TextView textView;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_merit_point);
        textView = findViewById(R.id.textview1);

        textView.setText(String.valueOf(point1));

    }
}
