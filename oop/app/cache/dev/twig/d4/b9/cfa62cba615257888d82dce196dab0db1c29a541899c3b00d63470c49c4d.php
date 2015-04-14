<?php

/* app/base.html.twig */
class __TwigTemplate_d4b9cfa62cba615257888d82dce196dab0db1c29a541899c3b00d63470c49c4d extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'body' => array($this, 'block_body'),
            'javascripts' => array($this, 'block_javascripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta charset=\"UTF-8\" />
        <meta http-equiv=\"Content-Type\" content=\"text/html\"; charset=\"utf-8\" />
        <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
        <title>";
        // line 7
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
        ";
        // line 8
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 13
        echo "        <link rel=\"icon\" type=\"image/x-icon\" href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" /> 
    </head>
    <body>
        ";
        // line 16
        ob_start();
        // line 17
        echo "        <div class=\"site_container\">
            <header>
                <ul class=\"admin_log\">
                    <li data-url_val=\"dialogue\" data-form_action=\"/app/example/login\" data-button_text=\"Log in\" data-title=\"Connect to your account\">Log in</li>
                    <li data-url_val=\"dialogue\" data-form_action=\"/app/example/signup\" data-button_text=\"Sign up\" data-title=\"Sign up for a free account\" data-button_sign_up=\"1\">Sign up</li>
                </ul>
            </header>
            ";
        // line 24
        $this->displayBlock('body', $context, $blocks);
        // line 25
        echo "        </div>
        ";
        // line 26
        $this->displayBlock('javascripts', $context, $blocks);
        // line 31
        echo "        ";
        echo trim(preg_replace('/>\s+</', '><', ob_get_clean()));
        // line 32
        echo "    </body>
</html>
";
    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        echo "Welcome!";
    }

    // line 8
    public function block_stylesheets($context, array $blocks = array())
    {
        // line 9
        echo "            <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("css/base.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
            <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css\">
            <link href=\"";
        // line 11
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/css/app.css"), "html", null, true);
        echo "\" type=\"text/css\" rel=\"stylesheet\" />
        ";
    }

    // line 24
    public function block_body($context, array $blocks = array())
    {
    }

    // line 26
    public function block_javascripts($context, array $blocks = array())
    {
        // line 27
        echo "            <script src=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/js/thirdparty/jquery-1.11.2.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 28
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/js/thirdparty/handlebars-1.0.rc.1.min.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
            <script src=\"";
        // line 29
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/app/js/main.js"), "html", null, true);
        echo "\" type=\"text/javascript\"></script>
        ";
    }

    public function getTemplateName()
    {
        return "app/base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  109 => 29,  105 => 28,  100 => 27,  97 => 26,  92 => 24,  86 => 11,  80 => 9,  77 => 8,  71 => 7,  65 => 32,  62 => 31,  60 => 26,  57 => 25,  55 => 24,  46 => 17,  44 => 16,  37 => 13,  35 => 8,  31 => 7,  23 => 1,);
    }
}
