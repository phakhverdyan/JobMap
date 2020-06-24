function CustomMarker(latlng, map, args, pictures) {
    this.latlng = latlng;
    this.args = args;
    this.setMap(map);
    this.pictures = pictures;
}

CustomMarker.prototype = new google.maps.OverlayView();

CustomMarker.prototype.draw = function () {

    var self = this;
    var div = this.div;

    if (!div) {
        div = this.div = document.createElement('div');
        div.className = 'marker animated zoomIn';

        if (self.pictures) {
            if (self.pictures.length === 1) {
                div.innerHTML = "<div class='outer'><img src='" + self.pictures[0] + "' style='width:40px; height:40px; vertical-align: middle; border-radius:5px;'></div>";
            } else if (self.pictures.length === 2) {
                div.innerHTML = div.innerHTML = "<div class='outer'><div>" +
                    "<img src='" + self.pictures[0] + "' style='outline: 3px solid rgba(0,0,0,0.2); outline-offset:-3px; height:40px; width:40px; vertical-align: middle;'> " +
                    "<img src='" + self.pictures[1] + "' style='margin-right:3px; outline: 3px solid rgba(0,0,0,0.2);  height:40px; outline-offset:-3px; width:40px; vertical-align: middle;'>" +
                    "</div></div>";
            } else if (self.pictures.length > 2) {
                var i = 0;
                var limit = 8;
                var html = "<div class='outer'><div>";
                var count = 0;
                var picturesCount = self.pictures.length;
                for (var j = 0; j < picturesCount; j++) {
                    var item = self.pictures[j];
                    if (i === 0) {
                        html += "<div>";
                    }
                    html += "<img src='" + item + "' style='outline: 3px solid rgba(0,0,0,0.2); outline-offset:-3px; height:20px; width:20px; vertical-align: middle;'>";
                    i++;
                    if (i === 4) {
                        html += "</div>";
                        i = 0;
                    } else if (j + 1 === picturesCount) {
                        html += "</div>";
                    }
                    count = j + 1;
                    if (count === limit) {
                        break;
                    }
                }
                var more = picturesCount - count;
                html += "</div>";
                if (more > 0) {
                    html += "<div style='width:40px; height:40px;'><span style='text-align:center; color:#0666df; padding-top:10px; display:block; opacity:0.4; font-size:17px;'>+" + more + "</span></div>";
                }
                html += "</div>";
                div.innerHTML = html;
            }
        }
        div.style.position = 'absolute';
        div.style.cursor = 'pointer';
        div.style.background = 'white';

        if (typeof(self.args.marker_id) !== 'undefined') {
            div.dataset.marker_id = self.args.marker_id;
        }

        google.maps.event.addDomListener(div, "click", function (event) {
            google.maps.event.trigger(self, "click");
        });

        var panes = this.getPanes();
        panes.overlayImage.appendChild(div);
    }

    var point = this.getProjection().fromLatLngToDivPixel(this.latlng);

    if (point) {
        div.style.left = (point.x - 10) + 'px';
        div.style.top = (point.y - 20) + 'px';
    }

    return self;
};

CustomMarker.prototype.remove = function () {
    if (this.div) {
        this.div.parentNode.removeChild(this.div);
        this.div = null;
    }
};

CustomMarker.prototype.getPosition = function () {
    return this.latlng;
};
