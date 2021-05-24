package com.example.pray_project;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;

public class prayList extends AppCompatActivity {

    ListView listview;
    int point,point1;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        setContentView(R.layout.activity_pray_list);
        listview = findViewById(R.id.listview);

        final ArrayList<String> arrayList = new ArrayList<>();



        arrayList.add("บทสวดบูชาพระรัตนตรัย");
        arrayList.add("บทสวดนมัสการพระรัตนตรัย");
        arrayList.add("บทสวดไตรสรณคมน์");
        arrayList.add("บทสวดชุมนุมเทวดา");
        arrayList.add("บทสวดพระพุทธคุณ");
        arrayList.add("บทสวดพุทธชัยมงคลคาถา");
        arrayList.add("บทสวดธรรมจักรกัปปวัตนสูตร");
        arrayList.add("คาถาชินบัญชร");
        arrayList.add("บทสวดพระคาถาบารมี ๓o ทัศ");
        arrayList.add("พระคาถาโพธิบาทป้องกันภัย ๑o ทิศ");
        arrayList.add("บทแผ่เมตตาให้สรรพสัตว์");
        arrayList.add("บทแผ่เมตตาให้ตนเอง");
        arrayList.add("บทแผ่ส่วนกุศล");
        arrayList.add("บทกรวดน้ำให้เจ้ากรรมนายเวร");
        arrayList.add("คำอธิษฐานขออโหสิกรรม");

        SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
        point1 = sharedPref.getInt("saved_point",0);

        ArrayAdapter arrayAdapter = new ArrayAdapter(this,android.R.layout.simple_list_item_1,arrayList);

        listview.setAdapter(arrayAdapter);

        listview.setOnItemClickListener(new AdapterView.OnItemClickListener(){
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l){
                Toast.makeText(prayList.this,"คุณเลือก:"+" "+arrayList.get(i).toString(),Toast.LENGTH_SHORT).show();
                if(arrayList.get(i) == "บทสวดบูชาพระรัตนตรัย"){
                    openPray("1");
                }else if(arrayList.get(i) == "บทสวดนมัสการพระรัตนตรัย"){
                    openPray("2");
                }else if(arrayList.get(i) == "บทสวดไตรสรณคมน์"){
                    openPray("3");
                }else if(arrayList.get(i) == "บทสวดชุมนุมเทวดา"){
                    openPray("4");
                }else if(arrayList.get(i) == "บทสวดพระพุทธคุณ"){
                    openPray("5");
                }else if(arrayList.get(i) == "บทสวดพุทธชัยมงคลคาถา"){
                    openPray("6");
                }else if(arrayList.get(i) == "บทสวดธรรมจักรกัปปวัตนสูตร"){
                    openPray("7");
                }else if(arrayList.get(i) == "คาถาชินบัญชร"){
                    openPray("8");
                }else if(arrayList.get(i) == "บทสวดพระคาถาบารมี ๓o ทัศ"){
                    openPray("9");
                }else if(arrayList.get(i) == "พระคาถาโพธิบาทป้องกันภัย ๑o ทิศ"){
                    openPray("10");
                }else if(arrayList.get(i) == "บทแผ่เมตตาให้สรรพสัตว์"){
                    openPray("11");
                }else if(arrayList.get(i) == "บทแผ่เมตตาให้ตนเอง"){
                    openPray("12");
                }else if(arrayList.get(i) == "บทแผ่ส่วนกุศล"){
                    openPray("13");
                }else if(arrayList.get(i) == "บทกรวดน้ำให้เจ้ากรรมนายเวร"){
                    openPray("14");
                }else if(arrayList.get(i) == "คำอธิษฐานขออโหสิกรรม"){
                    openPray("15");
                }else{

                }
            }
        });
    }



    public final  static String EXTRA_MESSAGE1 = "th.ac.th.Message1";
    public void openPray(String pray){
        if(pray == "1"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"1");
            startActivity(intent);
        }else if(pray == "2"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"2");
            startActivity(intent);
        }else if(pray == "3"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"3");
            startActivity(intent);
        }else if(pray == "4"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=100);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"4");
            startActivity(intent);
        }else if(pray == "5"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=100);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"5");
            startActivity(intent);
        }else if(pray == "6"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=150);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"6");
            startActivity(intent);
        }else if(pray == "7"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"7");
            startActivity(intent);
        }else if(pray == "8"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"8");
            startActivity(intent);
        }else if(pray == "9"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"9");
            startActivity(intent);
        }else if(pray == "10"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=50);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"10");
            startActivity(intent);
        }else if(pray == "11"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=35);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"11");
            startActivity(intent);
        }else if(pray == "12"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=10);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"12");
            startActivity(intent);
        }else if(pray == "13"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=10);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"13");
            startActivity(intent);
        }else if(pray == "14"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=10);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"14");
            startActivity(intent);
        }else if(pray == "15"){
            SharedPreferences sharedPref = PreferenceManager.getDefaultSharedPreferences(this);
            SharedPreferences.Editor editor = sharedPref.edit();
            editor.putInt("saved_point",point1+=10);
            editor.commit();
            Intent intent = new Intent(this,pray.class);
            intent.putExtra(EXTRA_MESSAGE1,"15");
            startActivity(intent);
        }else{

        }

    }
}

