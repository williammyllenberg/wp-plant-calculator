<?php

/*
* Plugin Name: Plant (PPFD / DLI) Calculator
* Plugin URI: https://www.linkedin.com/in/william-myllenberg/
* Description: Calculates lightning for plants with given values. Use [ppfd-calculator] or [dli-calculator].
* Version: 1
* Author: William Myllenberg
* Author URI: https://www.linkedin.com/in/william-myllenberg/
* License: GPL v2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

add_shortcode('ppfd-calculator', 'ppfd_calc_shortcode');
add_shortcode('dli-calculator', 'dli_calc_shortcode');

if (!function_exists('ppfd_calc_add_style')) {
    function ppfd_calc_add_style()
    {
        $plugin_url = plugin_dir_url(__FILE__);
        wp_enqueue_style('plant-calculator-style',  $plugin_url . "css/plant-calculator-style.css");
    }
}

if (!function_exists('ppfd_calc_shortcode')) {
    function ppfd_calc_shortcode($atts = [], $content = null)
    {
        ppfd_calc_add_style();

        $uniqueID = $uniqid = uniqid("plant-calcualtor-ppfd-");

        $output = '<div id="' . $uniqueID . '" class="plant-calculator">
                    <div>
                        <label for="measure-point-sum">Summan antal mätpunkter över mätytan:</label>
                        <input type="number" name="measure-point-sum" id="measure-point-sum">
                    </div>
                    <div>
                        <label for="measure-point-amount">Antal mätpunkter:</label>
                        <input type="number" name="measure-point-amount" id="measure-point-amount">
                    </div>
                    <div>
                        Medel PPFD: <span id="measure-point-result"></span>
                    </div>
                    <div>
                        <button id="measure-point-calculate">Beräkna</button>
                    </div>
                   </div>
                   <script>
                   jQuery(document).ready(function ($) {
                    var form = $("#' . $uniqueID . '");
                    form.find("button").click(function () {
                      var sum = form.find(\'input[name="measure-point-sum"]\').val();
                      var amount = form.find(\'input[name="measure-point-amount"]\').val();
                  
                      var calc = sum / amount;

                      if (isNaN(calc)) {
                        calc = 0;
                      }
                  
                      form.find("span").text(calc);
                    });
                  });
                   </script>
                   ';

        return $output;
    }
}

if (!function_exists('dli_calc_shortcode')) {
    function dli_calc_shortcode($atts = [], $content = null)
    {
        ppfd_calc_add_style();

        $uniqueID = $uniqid = uniqid("plant-calcualtor-dli-");

        $output = '<div id="' . $uniqueID . '" class="plant-calculator">
                    <div>
                        <label for="dli-ppfd-value">PPFD (umol/s/m2):</label>
                        <input type="number" name="dli-ppfd-value">
                    </div>
                    <div>
                        <label for="dli-time-value">Tid (timmar):</label>
                        <input type="number" name="dli-time-value">
                    </div>
                    <div>
                        DLI: <span id="dli-result"></span>
                    </div>
                    <div>
                        <button id="dli-calculate">Beräkna</button>
                    </div>
                   </div>
                   <script>
                   jQuery(document).ready(function ($) {
                    var form = $("#' . $uniqueID . '");
                    form.find("button").click(function () {
                      var ppfd = form.find(\'input[name="dli-ppfd-value"]\').val();
                      var time = form.find(\'input[name="dli-time-value"]\').val();
                  
                      var dli = ppfd * (3600 * time) / 1000000;
                  
                      form.find("span").text(dli);
                    });
                  });                  
                   </script>';

        return $output;
    }
}
