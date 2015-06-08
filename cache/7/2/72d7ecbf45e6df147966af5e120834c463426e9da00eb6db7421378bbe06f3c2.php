<?php

/* html_footer.twig */
class __TwigTemplate_72d7ecbf45e6df147966af5e120834c463426e9da00eb6db7421378bbe06f3c2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo twig_escape_filter($this->env, (isset($context["username"]) ? $context["username"] : null), "html", null, true);
        echo twig_escape_filter($this->env, (isset($context["title"]) ? $context["title"] : null), "html", null, true);
        echo "<hr>

      <footer>
        <p>&copy;  2014 </p>
      </footer>
    </div> <!-- /container -->        <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>
        <script>window.jQuery || document.write('<script src=\"javascripts/jquery-1.11.0.min.js\"><\\/script>')</script>

        <script src=\"javascripts/bootstrap.js\"></script>

        <script src=\"javascripts/main.js\"></script>

    </body>
</html>
";
    }

    public function getTemplateName()
    {
        return "html_footer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  19 => 1,);
    }
}
