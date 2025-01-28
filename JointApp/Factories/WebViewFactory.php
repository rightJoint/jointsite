<?php


namespace JointApp\Factories;


use JointApp\JointAppRequest;

class WebViewFactory
{
    public static function createViewFromRequest(JointAppRequest $request, $viewName)
    {
        if($viewName == 'JointApp\Views\View'){
            return new $viewName();
        }else{
            $webView = new $viewName($request->docRoot, $request->viewLang);
            $webView->configDir = $request->configDir;
            $webView->langRef = $request->langRef;
            $webView->routes_ns = $request->routes_ns;
            $webView->docRoot = $request->docRoot;
            $webView->langNs = $request->langNs;
            $webView->langLw = $request->langLw;
            $webView->langSl = $request->langSl;
            $webView->siteName = $request->siteName;
            $webView->langCanonical = $request->langCanonical;

            return $webView;
        }
    }
}