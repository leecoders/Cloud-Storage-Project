package com.example.me2in.webapp;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.webkit.*;
import android.widget.LinearLayout;

public class MainActivity extends AppCompatActivity {

    WebView web;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        LinearLayout layout = new LinearLayout(this);
        layout.setOrientation(LinearLayout.HORIZONTAL);
        web = new WebView(this);
        WebSettings webSet = web.getSettings();
        webSet.setJavaScriptEnabled(true);
        webSet.setUseWideViewPort(true);
        webSet.setAllowUniversalAccessFromFileURLs(true);
        webSet.setJavaScriptCanOpenWindowsAutomatically(true);
        webSet.setSupportMultipleWindows(true);
        webSet.setSaveFormData(true);
        webSet.setLayoutAlgorithm(WebSettings.LayoutAlgorithm.SINGLE_COLUMN);
        web.setWebChromeClient(new WebChromeClient());
        web.setVerticalScrollBarEnabled(false);
        web.setVerticalScrollbarOverlay(false);
        web.setHorizontalScrollBarEnabled(false);
        web.setHorizontalScrollbarOverlay(false);
        web.setInitialScale(100);
        web.setWebViewClient(new WebViewClient());
        web.loadUrl("http://jamcloud.iptime.org:10010/");
        layout.addView(web);
        setContentView(layout);
    }

        public void onBackPressed() {
            if (web.canGoBack()) web.goBack();
            else finish();
        }

    public  String creHtmlBody(String imagUrl){

        StringBuffer sb = new StringBuffer("<HTML>");

        sb.append("<HEAD>");

        sb.append("</HEAD>");

        sb.append("<BODY style='margin:0; padding:0; text-align:center;'>");    //중앙정렬

        sb.append("<img width='100%' height='100%' src=\"" + imagUrl+"\">"); //가득차게 나옴

        sb.append("</BODY>");

        sb.append("</HTML>");

        return sb.toString();

    }
}
