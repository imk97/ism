<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();

?>

<div class="qlue-poll <?php if($showBorder == "1") echo "qlue-poll_well"?> ">
    <form>
        <h3 id="qlue_poll-question<?php echo $id ?>"><?php echo $poll->poll->question?></h3>
        <div id="qlue_poll-results-chart<?php echo $id ?>" style="<?php if($displayType == "bar") echo "margin-left:-5px;";?><?php if($displayType == "pie") echo "margin-left:5px;";?>"></div>
        <ul id="qlue_poll-vote<?php echo $id ?>">
            <?php
                foreach($poll->awnsers as $awnser) {
                    echo '<li>';
                    echo '<input class="qlue-poll_input" type="radio" id="qlue_poll-awnser'.$awnser->id.'" name="poll" value="'. $awnser->id .'"> ';
                    echo "<h5 for=\"qlue_poll-awnser$awnser->id\">$awnser->name</h5>";
                    echo '</li>';
                }
            ?>
        </ul>
        <input type="hidden" name="poll_id" value="<?php $poll_id ?>">
        <input class="button" id="qlue_poll-submit_button<?php echo $id ?>" type="submit" name="submit" value="Vote">
        <?php if($displayCaptcha == 1) : ?>
            <div style="display:none" id="qlue_poll-captcha<?php echo $id ?>" class="g-recaptcha text-xs-center" data-size="compact" data-sitekey="<?php echo $captchaKey ?>" data-callback="voteCaptcha"></div>
        <?php endif;?>
    </form>
</div>

<style>
    li {
        list-style: none;
        padding-bottom: 5px;
    }
    table {
        border-collapse: inherit;
        width: 100%;
    }
    th, td {
        padding: 0.25rem;
        text-align: left;
        border: 1px solid #ccc;
        <?php if($borderColour != null) echo "border-color: $borderColour;";?>

    }
    tbody tr {
        <?php if($tableBackground != null) echo "background: $tableBackground;";?>
    }

    tbody tr:nth-child(odd) {
        background: #eee;
        <?php if($tableBackground2 != null) echo "background: $tableBackground2;";?>

    }

    table tr:last-child td:first-child {
        <?php if($tableRadius != null) echo "border-bottom-left-radius: $tableRadius;" ?>
    }

    table tr:last-child td:last-child {
        <?php if($tableRadius != null) echo "border-bottom-right-radius: $tableRadius;" ?>
    }

    table tr:first-child th:first-child {
        <?php if($tableRadius != null) echo "border-top-left-radius: $tableRadius;" ?>
    }

    table tr:first-child th:last-child {
        <?php if($tableRadius != null) echo "border-top-right-radius: $tableRadius;" ?>
    }

    .qp-well {
        padding: 10px;
        <?php if($width != null) echo "width: $width;";?>
        <?php if($height != null) echo "height: $width;";?>
        <?php if($borderRadius != null) echo "border-radius: $borderRadius;";?>
        <?php if($borderColour != null) echo "border-color: $borderColour;";?>
        <?php if($backgroundColour != null) echo "background-color: $backgroundColour;";?>
        <?php if($textColour != null) echo "color: $textColour;";?>
    }

    .grecaptcha-badge {
	    visibility: collapse !important;  
    }

    .text-xs-center {
        text-align: center;
    }

    .g-recaptcha {
        display: inline-block;
    }

    .qlue-poll_button {

    }

    .qlue-poll p {
        <?php if($textColour != null) echo "color: $textColour;";?>
    }

    .qlue-poll li {
        <?php if($textColour != null) echo "color: $textColour;";?>
    }

    .qlue-poll .apexcharts-text, .qlue-poll tspan, .apexcharts-yaxis-texts-g {
        <?php if($textColour != null) echo "color: $textColour; !important";?>
    }

    .qlue-poll_well {
        border: 1px solid;
        <?php if($width != null) echo "width: $width;";?>
        <?php if($height != null) echo "height: $width;";?>
        <?php if($borderRadius != null) echo "border-radius: $borderRadius;";?>
        <?php if($borderColour != null) echo "border-color: $borderColour;";?>
        <?php if($backgroundColour != null) echo "background-color: $backgroundColour;";?>
        <?php if($textColour != null) echo "color: $textColour;";?>
        padding:5px;
    }

   .qlue-poll_input {
        margin-right: 5px;
        float:left;
   }

   label {
       margin-left:20px;
   }
</style>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
    var type = "<?php echo $displayType ?>";
    var hideCount = <?php echo $hideCount?>;
    var figure = '<?php echo $displayFigure?>';
    var captcha = <?php echo $displayCaptcha?>;
    var pollAwnser = "";

    var createElement;

    var labelColour = '<?=$textColour?>';
    var fillColour = '<?=$graphFillColour?>';
    var tooltip = '<?=$graphTooltip?>';
    var rua = '<?=$rua?>';

    jQuery(document).ready(function($) {


        $("#qlue_poll-submit_button<?php echo $id ?>").click(function(e) { 
            e.preventDefault();
            var awnser = $("input[name='poll']:checked").val();
            pollAwnser = awnser;

            $('#qlue_poll-vote<?php echo $id ?>').remove();
            $('#qlue_poll-submit_button<?php echo $id ?>').remove();

            if(rua == '1' && '<?php echo $loggedIn?>' != '1') {
                $('<p>Please login to vote.</p>').insertAfter(document.getElementById('#qlue_poll-question<?php echo $id ?>'));
                return;
            }

            if (captcha == 1) {
                $('#qlue_poll-captcha<?php echo $id ?>').css('display', 'initial');
            } else {
                vote();
            }
        });

        if(!<?php echo $allowed ?>) {
            $("#qlue_poll-submit_button<?php echo $id ?>").trigger('click');
        }

        createElement = function() {
            $('<div id="qlue_poll-results-chart<?php echo $id ?>"></div>').insertAfter(document.getElementById('#qlue_poll-question<?php echo $id ?>'));
        }
    });

    function voteCaptcha(token) {
        return new Promise(function(resolve, reject) { 
            document.getElementById('qlue_poll-captcha<?php echo $id ?>').remove();
            vote(token);
            resolve();
        }).catch(error => {
        });
    }

    function vote(token = "none") {
        var awnser = pollAwnser;

        jQuery.ajax({
            url: "index.php?option=com_ajax&module=qluepoll&format=json", 
            type: "POST",
            data: {
                'awnser' : awnser,
                'poll_id' : <?php echo $poll->poll->id ?>,
                'captcha' : token,
                'mid' : <?php echo $mid?>
            }, 
            success: function(result) { 
                var awnsers = result.data.data;
                var total = 0;
                for(var i = 0; i < awnsers.length; i++) {
                    total += awnsers[i].votes;
                }

                if(result.data.success == false) {
                    jQuery('<div><p>Sorry, we can\'t take your vote at this time.</p></div>').insertAfter($('#qlue_poll-question<?php echo $id ?>'));
                    return;
                }

                //TODO check capture result

                if(hideCount == 0) {
                    jQuery('<div><p>Thank you for voting.</p></div>').insertAfter(document.getElementById('qlue_poll-question<?php echo $id ?>'));
                    return;
                }

                if(type == "table") {
                    jQuery('<table id="qlue_poll-results-table<?php echo $id ?>"><tr><th>Answer</th><th>Votes</th></tr></table>').insertAfter(document.getElementById('qlue_poll-question<?php echo $id ?>'));
                    for(var i = 0; i < awnsers.length; i++) {
                        var awn = awnsers[i];
                        var value;
                        if(figure == "percentage") {
                            value = Math.round((100 / total * awn.votes) * 10)/10 + "%";
                        } else {
                            value = awn.votes;
                        }
                        jQuery('#qlue_poll-results-table<?php echo $id ?> tr:last').after('<tr><td>' + awn.awnser + '</td><td>' + value + '</td></tr>');
                    }

                } else if (type == "pie") {
                    pie(awnsers, figure);
                } else if (type == "bar") {
                    bar(awnsers, figure);
                }
            }
        });
    }

    function pie(awnsers, figure) {
        var labels = [];
        var values = [];
        var colours = [];


        for(awnser in awnsers) {
            labels.push(awnsers[awnser].awnser);
            values.push(awnsers[awnser].votes);
        }

        for(label in labels) {
            colours.push(labelColour);
        }


        var options = {
            chart: {
                type: 'pie',
                width: '105%',
                height: '90px'
            },
            series: values,
            labels: labels,
            legend: {
                show: true,
            },
            legend: {
                labels: {
                    colors: colours
                }
            },
            tooltip: {
                enabled: tooltip == '1'
            }
        }

        if(figure == "number") {
            options.dataLabels = {
                formatter: function(val, opts) {
                    return opts.w.config.series[opts.seriesIndex];
                }
            }
        }

        var chart = new ApexCharts(document.getElementById('qlue_poll-results-chart<?php echo $id ?>'), options);
        chart.render();
        console.log(chart);
    }

    function bar(awnsers, figure) {
        var labels = [];
        var values = [];
        var colours = [];

        for(awnser in awnsers) {
            labels.push(awnsers[awnser].awnser);
            values.push(awnsers[awnser].votes);
        }

        for(label in labels) {
            colours.push(labelColour);
        }

        console.log(colours);

        var options = {
            series: [{
                name: "Votes",
                data: values
            }],
            chart: {
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            xaxis: {
                categories: labels,
                labels: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        colors: colours
                    }
                }
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                }
            },
            tooltip: {
                enabled: tooltip == '1'
            }
        }

        if(fillColour != '') {
            options.fill = {
                colors: fillColour,
            };
        }

        if(figure == "percentage") {
            options.dataLabels = {
                formatter: function(val, opts) {
                    var total = 0;
                    for(var awnser in opts.w.config.series[0]['data']) {
                        total += Number(opts.w.config.series[0]['data'][awnser]);
                    }

                    console.log(opts);
                    console.log(total);

                    return String(Math.trunc((100 / total * val) )) + "%";
                }
            }
        }

        var chart = new ApexCharts(document.getElementById('qlue_poll-results-chart<?php echo $id ?>'), options);
        chart.render();
    }

</script>