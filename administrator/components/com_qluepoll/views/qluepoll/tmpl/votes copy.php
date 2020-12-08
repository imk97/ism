<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_qluepoll
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

    $model = $this->getModel ();
    $awnsers = $model->awnsers;
    $votes = $model->votes;

    $total = 0;
    foreach($awnsers as $awnser) {
        $total += $awnser->votes;
    }

    $geoVotes = [];

    foreach($votes as $vote) {
        if($vote->country_code != "") {
            $geoVotes[$vote->country_code] = 0;
        }
    }

    foreach($votes as $vote) {
        if($vote->country_code != "") {
            $geoVotes[$vote->country_code] += 1;
        }
    }

    $awnsersArray = array();
    foreach($awnsers as $awnser) {
        $key = $awnser->id;
        $awnsersArray[$key] = 0;
    }

    $userVotes = array();
    $userVotes['0'] = array('name' => 'Guests', 'awnsers' => $awnsersArray, 'votes' => 0);

    foreach($votes as &$vote) {
        if($vote->user_id == null) $vote->user_id = 0;

        if(!isset($userVotes["$vote->user_id"])) {
            $user = JFactory::getUser($vote->user_id);
            $userVotes["$vote->user_id"] = array('name' => $user->username, 'awnsers' => $awnsersArray, 'votes' => 0);
        }

        //TOD if awnser not in awnsers do nothing!!!!!

        $userVotes[$vote->user_id]['awnsers'][$vote->awnser_id] =  $userVotes[$vote->user_id]['awnsers'][$vote->awnser_id] + 1;
        $userVotes[$vote->user_id]['votes'] = $userVotes[$vote->user_id]['votes'] + 1;

    }

    $document = JFactory::getDocument();
    $document->addStyleSheet('https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css');


?>

<form action="<?php echo JRoute::_('index.php?option=com_qluepoll&layout=edit&id=' . (int) $this->item->id); ?>"
    method="post" name="adminForm" id="adminForm">    <input type="hidden" name="task" value="qluepoll.edit" />
    <?php echo JHtml::_('form.token'); ?></form>
    <!-- <div class="row" style="margin:10px">
        <div class="span6">
            <div style="max-height:400px;overflow-y:scroll;width:fit-content">
                <table>
                    <thead>
                        <th>Name</th>
                        <?php foreach($awnsers as $awnser): ?> 
                            <th><?=$awnser->name?></th>
                        <?php endforeach?>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <?php foreach($userVotes as $user): ?>
                            <tr>
                                <td><?=$user['name']?></td>
                                <?php foreach($awnsers as $awnser): ?>
                                    <td><?=$user['awnsers'][$awnser->id]?></td>
                                <?php endforeach; ?>
                                <td><?=$user['votes']?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="span6">
            
        </div>
    </div> -->
<div class="row" style="margin:10px">
    
    <div class="span6 card">
        <div id="pie-chart" style="padding-top:10px"></div>
    </div>
    <div class="span6">
        <div id="bar-graph"></div>
    </div>
</div>
<div class="row">
    <div class="span12 card">
        <div id="map" style="width:100%; height: 450px"></div>
    </div>
</div>

<style>
    table {
        border-collapse: collapse;
        max-width: 30%;
    }
    th, td {
        padding: 0.25rem;
        border: 1px solid #ccc;
    }
    tbody tr:nth-child(odd) {
        background: #eee;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="https://cdn.jsdelivr.net/npm/jqvmap@1.5.0/dist/jquery.vmap.js" integrity="sha256-CwEfAvS2crJkNJaRPVsmHaSSDHGgZdMcmjgGjD2r7Tw=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jqvmap@1.5.0/dist/maps/jquery.vmap.world.js" integrity="sha256-gSvZVL/Ip1QHp+3bhHaWb+sNa3I6IcSTah6icCofum4=" crossorigin="anonymous"></script>
<script>

    var awnsers = JSON.parse('<?php echo json_encode($awnsers)?>');
    var geoVotes = JSON.parse('<?php echo json_encode($geoVotes)?>');
    geoVotes = Object.assign({}, geoVotes);

    //so the map lib is case sensitive...
    var key, keys = Object.keys(geoVotes);
    var n = keys.length;
    var newobj={}
    while (n--) {
        key = keys[n];
        newobj[key.toLowerCase()] = geoVotes[key];
    }

    jQuery(document).ready(function($) {
        console.log(awnsers);
        console.log(geoVotes);
        bar(awnsers);
        pie(awnsers);

        $('#map').vectorMap({ 
            map: 'world_en',
            backgroundColor: '#fff',
            color: '#ffffff',
            hoverOpacity: 0.7,
            selectedColor: '#666666',
            enableZoom: false,
            showTooltip: true,
            scaleColors: ['#C8EEFF', '#006491'],
            values: newobj,
            normalizeFunction: 'polynomial'
        });

    });

    function bar(awnsers) {
        var labels = [];
        var values = [];

        for(awnser in awnsers) {
            labels.push(awnsers[awnser].name);
            values.push(awnsers[awnser].votes);
        }

        var options = {
            series: [{
                data: values
            }],
            chart: {
                type: 'bar',
                // width: '30%',
                toolbar: {
                    show: false
                }
            },
            xaxis: {
                categories: labels,
                labels: {
                    show: true
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                }
            },
        }

        var chart = new ApexCharts(document.getElementById('bar-graph'), options);
        chart.render();
    }

    function pie(awnsers) {
        var labels = [];
        var values = [];

        for(awnser in awnsers) {
            labels.push(awnsers[awnser].name);
            values.push(awnsers[awnser].votes);
        }

        var options = {
            chart: {
                type: 'pie',
                width: '76%'
            },
            series: values,
            labels: labels,
        }

        var chart = new ApexCharts(document.getElementById('pie-chart'), options);
        chart.render();
    }
</script>