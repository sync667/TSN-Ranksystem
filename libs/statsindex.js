var i, tsn = new Array;
for (i = 1; i < 34; i++) tsn[i] = document.getElementById("tsn" + i).value;
Morris.Donut(
    {element: "time-gap-donut", data: [{label: tsn[1], value: tsn[4]}, {label: tsn[2], value: tsn[5]}]}), Morris.Donut({
    element: "client-version-donut",
    data: [{label: tsn[6], value: tsn[11]}, {label: tsn[7], value: tsn[12]}, {
        label: tsn[8],
        value: tsn[13]
    }, {label: tsn[9], value: tsn[14]}, {label: tsn[10], value: tsn[15]}, {label: tsn[3], value: tsn[16]}],
    colors: ["#5cb85c", "#73C773", "#8DD68D", "#AAE6AA", "#C9F5C9", "#E6FFE6"]
}), Morris.Donut({
    element: "user-descent-donut",
    data: [{label: tsn[17], value: tsn[22]}, {label: tsn[18], value: tsn[23]}, {
        label: tsn[19],
        value: tsn[24]
    }, {label: tsn[20], value: tsn[25]}, {label: tsn[21], value: tsn[26]}, {label: tsn[3], value: tsn[27]}],
    colors: ["#f0ad4e", "#ffc675", "#fecf8d", "#ffdfb1", "#fce8cb", "#fdf3e5"]
}), Morris.Donut({
    element: "user-platform-donut",
    data: [{label: "Windows", value: tsn[28]}, {label: "Linux", value: tsn[29]}, {
        label: "Android",
        value: tsn[30]
    }, {label: "iOS", value: tsn[31]}, {label: "OS X", value: tsn[32]}, {label: tsn[3], value: tsn[33]}],
    colors: ["#d9534f", "#FF4040", "#FF5050", "#FF6060", "#FF7070", "#FF8080"]
}), $(function () {
    var e = Morris.Area({
        element: "serverusagechart",
        behaveLikeLine: !0,
        data: [],
        xkey: "y",
        ykeys: ["a", "b"],
        hideHover: "auto",
        fillOpacity: .4,
        hoverCallback: function (e, t, n, a) {
            return "<b>" + a.y + "</b><br><div class='morris-hover-point text-primary'>Użytkowników: " + a.a + "</div><div class='morris-hover-point text-muted'>Kanałów: " + a.b + "</div>"
        },
        labels: ["Użytkowników", "Kanałów"],
        resize: !0
    });
    var e2 = Morris.Area({
        element: "serverusagenewchart",
        behaveLikeLine: !0,
        data: [],
        xkey: "y",
        ykeys: ["a", "b"],
        hideHover: "auto",
        fillOpacity: .4,
        hoverCallback: function (e, t, n, a) {
            return "<b>" + a.y + "</b><br><div class='morris-hover-point text-primary'>Ogólnie online: " + a.a + "</div><div class='morris-hover-point text-muted'>Nowych: " + a.b + "</div>"
        },
        labels: ["Ogólnie online", "Nowych"],
        resize: !0
    });
    $("#period").on("change", function () {
        var t = $(this).val();
        $.ajax({
            type: "POST",
            url: "update_graph.php?serverusagechart=" + t,
            data: 0,
            dataType: "json",
            success: function (t) {
                console.log(t), e.setData(t)
            }
        })
    });
    $("#periodnew").on("change", function () {
        var t = $(this).val();
        $.ajax({
            type: "POST",
            url: "update_graph.php?serverusagenewchart=" + t,
            data: 0,
            dataType: "json",
            success: function (t) {
                console.log(t), e2.setData(t)
            }
        })
    })
}), $(document).ready(function (e) {
    $("#period").trigger("change")
});
$(document).ready(function (e2) {
    $("#periodnew").trigger("change")
});
var a = document.getElementById("days"), b = document.getElementById("hours"), c = document.getElementById("minutes"),
    d = document.getElementById("seconds"), e = document.getElementById("sut").value;

function setTime() {
    ++e, d.innerHTML = pad(e % 60), c.innerHTML = pad(parseInt(e / 60) % 60), b.innerHTML = pad(
        parseInt(e / 3600) % 24), a.innerHTML = pad(parseInt(e / 86400))
}

function pad(e) {
    var t = e + "";
    return t.length < 2 ? "0" + t : t
}

setInterval(setTime, 1e3);