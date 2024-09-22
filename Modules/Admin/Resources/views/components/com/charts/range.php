<div id="<?= $controller . "-" . randomKey() ?>" class="range-slider" style='--min:<?= $min ?? 0 ?>; --max:<?= $max ?? 0 ?>; --step:<?= $step ?? 5 ?>; --value: <?= @$info['data'][$controller][$name] ?? 0 ?>; --text-value:"<?= @$info['data'][$controller][$name] ?? 0 ?>";'>
    <input name="frm_data[data][<?= $controller ?>][<?= $name ?>]" type="range" min="<?= $min ?? 0 ?>" max="<?= $max ?? 100 ?>" step="<?= $step ?? 5 ?>" value="<?= @$info['data'][$controller][$name] ?? 0 ?>" oninput="this.parentNode.style.setProperty('--value',this.value); this.parentNode.style.setProperty('--text-value', JSON.stringify(this.value))">
    <output></output>
    <div class='range-slider__progress'></div>
</div>