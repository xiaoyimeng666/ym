<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* /Index/index.html */
class __TwigTemplate_705f87b7f3ebfb0955bda321e7486c1beb209ee30b2da7b8871881e2a5971f56 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>Title</title>
</head>
<body>
<p>tenet</p>
<textarea name=\"text\" id=\"name\" cols=\"30\" rows=\"10\"></textarea>
<button id=\"do\">转ssssss换</button>
<textarea name=\"text2\" id=\"name2\" cols=\"30\" rows=\"10\"></textarea>

<p>------------------------------------分割线-----------------------------------</p>
<a href=\"/index/test\">to test</a>
<form action=\"";
        // line 15
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["url"] ?? null), "url", [0 => "index/add"], "method", false, false, false, 15), "html", null, true);
        echo "\" method=\"post\" enctype=\"multipart/form-data\">
    <input type=\"file\" name=\"file\">
    <input type=\"submit\" value=\"upload\">
</form>
11
<p>------------------------------------分割线-----------------------------------</p>

<div id=\"b1\" style=\"height: 300px;width: 300px;background: #005cbf\">
    <div id=\"b2\" style=\"height: 200px;width: 300px;background: #007bff;\">
        <div id=\"b3\" style=\"height: 100px;width: 300px;background: #7abaff\">

        </div>
    </div>
</div>

<p>------------------------------------分割线-----------------------------------</p>
<p>《依梦》改造中</p>
</body>
<script src=\"";
        // line 33
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["url"] ?? null), "static_url", [0 => "static/jquery/jquery.min.js"], "method", false, false, false, 33), "html", null, true);
        echo "\"></script>
<script>
    \$(\"#do\").click(function(){
        var text = \$(\"#name\").val();
        \$(\"#name2\").val(text.split('').reverse().join(''));
    })
    \$(\"#b1\").click(function () {
        console.log('1');
        event.stopPropagation();
    })
    \$(\"#b2\").click(function () {
        console.log('2');
        event.stopPropagation();
    })
    \$(\"#b3\").click(function () {
        console.log('3');
        event.stopPropagation();
    })
    \$(\"#name\").val('1,5,9,6,4,8,2,7,3');
    kp();
function kp() {
}
</script>
</html>";
    }

    public function getTemplateName()
    {
        return "/Index/index.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  74 => 33,  53 => 15,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "/Index/index.html", "E:\\phpstudy_pro\\WWW\\new\\app\\views\\view\\Index\\index.html");
    }
}
