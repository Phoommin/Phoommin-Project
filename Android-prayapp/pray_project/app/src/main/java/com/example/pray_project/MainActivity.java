package com.example.pray_project;

import androidx.annotation.RequiresApi;
import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Build;
import android.os.Bundle;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.TextView;


import java.util.ArrayList;


public class MainActivity extends AppCompatActivity {

    ListView listview;

    int[] images ={R.drawable.pray, R.drawable.point};
    String[] menu = {"บทสวด","แต้มบุญ"};
    @RequiresApi(api = Build.VERSION_CODES.LOLLIPOP)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        listview = findViewById(R.id.listview);


        final ArrayList<String> arrayList = new ArrayList<>();

        arrayList.add("บทสวด");
        arrayList.add("แต้มบุญ");
        ArrayAdapter arrayAdapter = new ArrayAdapter(this,android.R.layout.simple_list_item_1,arrayList);

        listview.setAdapter(arrayAdapter);

        CustomAdaptor customAdaptor = new CustomAdaptor();
        listview.setAdapter(customAdaptor);
        listview.setOnItemClickListener(new AdapterView.OnItemClickListener(){
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l){
                //     Toast.makeText(MainActivity.this,"click item:"+" "+arrayList.get(i).toString(),Toast.LENGTH_SHORT).show();
                if(arrayList.get(i) == "บทสวด"){
                    openPrayList();
                }else {
                    openMeritPoint();
                }
            }
        });


    }

    class CustomAdaptor extends BaseAdapter{

        @Override
        public int getCount() {
            return images.length;
        }

        @Override
        public Object getItem(int position) {
            return null;
        }

        @Override
        public long getItemId(int position) {
            return 0;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View view = getLayoutInflater().inflate(R.layout.customlayout, null);
            ImageView mImageView = view.findViewById(R.id.imageView2);
            TextView mTextview = view.findViewById(R.id.textview8);

            mImageView.setImageResource(images[position]);
            mTextview.setText(menu[position]);
            return view;
        }
    }

    public void openPrayList(){
        Intent intent = new Intent(this, prayList.class);
        startActivity(intent);
    }

    public void openMeritPoint(){
        Intent intent = new Intent(this, meritPoint.class);
        startActivity(intent);
    }


}
