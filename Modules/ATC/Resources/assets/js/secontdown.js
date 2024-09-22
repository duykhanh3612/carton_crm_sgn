function countitround() {
    var glob = {
        deg: function(e) {
            return Math.PI / 180 * e - Math.PI / 180 * 90
        },
        size: {
            x: function(e) {
                return glob.settings["size" + e] / 2
            },
            y: function(e) {
                return glob.settings["size" + e] / 2
            },
            z: function(e) {
                return glob.settings["size" + e] / 2 - (Number(glob.settings["backgroundwidth" + e]) > Number(glob.settings["frontwidth" + e]) ? glob.settings["backgroundwidth" + e] : glob.settings["frontwidth" + e]) / 2 - glob.settings["glowwidth" + e]
            }
        },
        complete: function() {
            if (jQuery.trim(glob.settings.callback) != '') {
                eval(glob.settings.callback)
            }
        }
    };
    this.init = function(e) {
        glob.settings = e;
        glob.seconds = glob.settings.seconds;
        clock.set.background();
        clock.set.seconds();
        clock.start()
    };
    var clock = {
        set: {
            background: function() {
                jQuery("#" + glob.settings.unique).find(".canvas_background").each(function() {
                    var e;
                    if (jQuery(this).parent().attr("class").indexOf("seconds") >= 1) e = 4;
                    var t = jQuery(this).get(0);
                    var n = t.getContext("2d");
                    n.canvas.height = glob.settings["size" + e];
                    n.canvas.width = glob.settings["size" + e];
                    n.clearRect(0, 0, t.width, t.height);
                    n.beginPath();
                    n.strokeStyle = glob.settings["backgroundcolor" + e];
                    n.arc(glob.size.x(e), glob.size.y(e), glob.size.z(e), glob.deg(0), glob.deg(360));
                    n.lineWidth = glob.settings["backgroundwidth" + e];
                    n.stroke()
                })
            },
            seconds: function() {
                var e = jQuery("#" + glob.settings.unique).find(".canvas_seconds").get(0);
                var t = e.getContext("2d");
                t.canvas.height = glob.settings.size4;
                t.canvas.width = glob.settings.size4;
                t.clearRect(0, 0, e.width, e.height);
                t.beginPath();
                t.strokeStyle = glob.settings.color4;
                t.shadowBlur = glob.settings.glowwidth4;
                t.shadowOffsetX = 0;
                t.shadowOffsetY = 0;
                t.shadowColor = glob.settings.glow4;
                var n = 6 * glob.seconds;
                var r = glob.seconds;
                t.arc(glob.size.x(4), glob.size.y(4), glob.size.z(4), glob.deg(0), glob.deg(n));
                t.lineWidth = glob.settings.frontwidth4;
                t.stroke();
                jQuery("#" + glob.settings.unique).find(".countitround_seconds_count").text(r)
            }
        },
        start: function() {
            var e;
            e = setInterval(function() {
                if (glob.seconds <= 0) {
                    glob.complete();
                    clearInterval(e);
                    return
                } else {
                    glob.seconds--
                }
                clock.set.seconds()
            }, 1e3)
        }
    }
}
jQuery(document).ready(function() {
    var e = 0;
    while (countitroundinstance[e]) {
        (new countitround).init(countitroundinstance[e]);
        e++
    }
})

