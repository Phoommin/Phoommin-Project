package com.example.pray_project;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.media.MediaPlayer;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;



public class pray extends AppCompatActivity {
    EditText textpratview;
    TextView textView;
    private String pray = " ";
    private MediaPlayer praySoundOne,praySoundTwo,praySoundThree,praySoundFour,praySoundFive,praySoundSix,praySoundSeven,praySoundEight
                        ,praySoundNine,praySoundTen,praySoundOnnOne,praySoundOneTwo,praySoundOneThree,praySoundOneFour,praySoundOneFive;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_pray);

        final Button playPray = this.findViewById(R.id.playPray);
        final Button stopPray = this.findViewById(R.id.stopPray);
        textpratview = findViewById(R.id.editText);
        textView = findViewById(R.id.textView);
        Intent intent = getIntent();
        pray = intent.getStringExtra(prayList.EXTRA_MESSAGE1);
//        textpratview = findViewById(R.id.editText);
//        textpratview.setText(pray);
        playPray.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onPlayPray();
                playPray.setVisibility(View.GONE);
                stopPray.setVisibility(View.VISIBLE);
            }
        });

        stopPray.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                onPlayStop();
                playPray.setVisibility(View.VISIBLE);
                stopPray.setVisibility(View.GONE);
            }
        });


        if(pray.equals("1")){
            textpratview.setText(R.string.one);
            textView.setText("     บทสวดบูชาพระรัตนตรัย");
        }else if(pray.equals("2")){
            textpratview.setText(R.string.two);
            textView.setText("     บทสวดนมัสการพระรัตนตรัย");
        }else if(pray.equals("3")){
            textpratview.setText(R.string.three);
            textView.setText("     บทสวดไตรสรณคมน์");
        }else if(pray.equals("4")){
            textpratview.setText(R.string.four);
            textView.setText("     บทสวดชุมนุมเทวดา");
        }else if(pray.equals("5")){
            textpratview.setText(R.string.five);
            textView.setText("     บทสวดพระพุทธคุณ");
        }else if(pray.equals("6")){
            textpratview.setText(R.string.six);
            textView.setText("     บทสวดพุทธชัยมงคลคาถา");
        }else if(pray.equals("7")){
            textpratview.setText(R.string.seven);
            textView.setText("     บทสวดธรรมจักรกัปปวัตนสูตร");
        }else if(pray.equals("8")){
            textpratview.setText(R.string.eight);
            textView.setText("     คาถาชินบัญชร");
        }else if(pray.equals("9")){
            textpratview.setText(R.string.nine);
            textView.setText("     คาถาบารมี ๓o ทิศ");
        }else if(pray.equals("10")){
            textpratview.setText(R.string.ten);
            textView.setText("     พระคาถาโพธิบาทป้องกันภัย ๑o ทิศ");
        }else if(pray.equals("11")){
            textpratview.setText(R.string.oneone);
            textView.setText("     บทแผ่เมตตาให้สรรพสัตว์");
        }else if(pray.equals("12")){
            textpratview.setText(R.string.onetwo);
            textView.setText("     บทแผ่เมตตาให้ตนเอง");
        }else if(pray.equals("13")){
            textpratview.setText(R.string.onethree);
            textView.setText("     บทแผ่ส่วนกุศล");
        }else if(pray.equals("14")){
            textpratview.setText(R.string.onefour);
            textView.setText("     บทกรวดน้ำให้เจ้ากรรมนายเวร");
        }else if(pray.equals("15")){
            textpratview.setText(R.string.onefive);
            textView.setText("     คำอธิษฐานขออโหสิกรรม");
        }else{

        }

        praySoundOne = MediaPlayer.create(this, R.raw.one);
        praySoundTwo = MediaPlayer.create(this, R.raw.two);
        praySoundThree = MediaPlayer.create(this, R.raw.three);
        praySoundFour = MediaPlayer.create(this, R.raw.four);
        praySoundFive = MediaPlayer.create(this, R.raw.five);
        praySoundSix = MediaPlayer.create(this, R.raw.six);
        praySoundSeven = MediaPlayer.create(this, R.raw.seven);
        praySoundEight = MediaPlayer.create(this, R.raw.eight);
        praySoundNine = MediaPlayer.create(this, R.raw.nine);
        praySoundTen = MediaPlayer.create(this, R.raw.ten);
        praySoundOnnOne = MediaPlayer.create(this, R.raw.oneone);
        praySoundOneTwo = MediaPlayer.create(this, R.raw.onetwo);
        praySoundOneThree = MediaPlayer.create(this, R.raw.onethree);
        praySoundOneFour = MediaPlayer.create(this, R.raw.onefour);
        praySoundOneFive = MediaPlayer.create(this, R.raw.onefive);


    }


    public void onPlayPray(){

        if(pray.equals("1")){
            praySoundOne.start();
        }else if(pray.equals("2")){
            praySoundTwo.start();
        }else if(pray.equals("3")){
            praySoundThree.start();
        }else if(pray.equals("4")){
            praySoundFour.start();
        }else if(pray.equals("5")){
            praySoundFive.start();
        }else if(pray.equals("6")){
            praySoundSix.start();
        }else if(pray.equals("7")){
            praySoundSeven.start();
        }else if(pray.equals("8")){
            praySoundEight.start();
        }else if(pray.equals("9")){
            praySoundNine.start();
        }else if(pray.equals("10")){
            praySoundTen.start();
        }else if(pray.equals("11")){
            praySoundOnnOne.start();
        }else if(pray.equals("12")){
            praySoundOneTwo.start();
        }else if(pray.equals("13")){
            praySoundOneThree.start();
        }else if(pray.equals("14")){
            praySoundOneFour.start();
        }else if(pray.equals("15")){
            praySoundOneFive.start();
        }else{

        }
    }

    public void onPlayStop(){

        if(pray.equals("1")){
            praySoundOne.pause();
        }else if(pray.equals("2")){
            praySoundTwo.pause();
        }else if(pray.equals("3")){
            praySoundThree.pause();
        }else if(pray.equals("4")){
            praySoundFour.pause();
        }else if(pray.equals("5")){
            praySoundFive.pause();
        }else if(pray.equals("6")){
            praySoundSix.pause();
        }else if(pray.equals("7")){
            praySoundSeven.pause();
        }else if(pray.equals("8")){
            praySoundEight.pause();
        }else if(pray.equals("9")){
            praySoundNine.pause();
        }else if(pray.equals("10")){
            praySoundTen.pause();
        }else if(pray.equals("11")){
            praySoundOnnOne.pause();
        }else if(pray.equals("12")){
            praySoundOneTwo.pause();
        }else if(pray.equals("13")){
            praySoundOneThree.pause();
        }else if(pray.equals("14")){
            praySoundOneFour.pause();
        }else if(pray.equals("15")){
            praySoundOneFive.pause();
        }else{

        }
    }
}

