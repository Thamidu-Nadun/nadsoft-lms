<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src='assets/vendors/scroll/scrollbar.min.js'></script>
<script src="assets/js/functions.js"></script>
<script src="assets/vendors/chart/chart.min.js"></script>
<!-- <script src="assets/js/admin.js"></script> -->
<script>
    function init_data(label, backgroundColor, borderColor, borderWidth, data, pointBackgroundColor, pointHoverBackgroundColor) {
        chart_data = [{
            label: label,
            backgroundColor: backgroundColor,
            borderColor: borderColor,
            borderWidth: "3",
            data: data,
            pointRadius: 4,
            pointHoverRadius: 4,
            pointHitRadius: 10,
            pointBackgroundColor: pointBackgroundColor,
            pointHoverBackgroundColor: pointHoverBackgroundColor,
            pointBorderWidth: "3",
        }];
        return chart_data;
    }


    (function ($) {

        'use strict';

        var AdminBuilder = function () {

            var checkSelectorExistence = function (selectorName) {
                if (jQuery(selectorName).length > 0) { return true; } else { return false; }
            };

            var searchToggle = function () {
                $(".ttr-search-toggle").on("click", function (e) {
                    e.preventDefault();
                    $(".ttr-search-bar").toggleClass("active");
                })
            };

            var closeNav = function () {
                $(".ttr-overlay, .ttr-sidebar-toggle-button").on("click", function () {
                    $("body").removeClass("ttr-opened-sidebar"), $("body").removeClass("ttr-body-fixed");
                })
            };

            var leftSidebar = function () {

                $(".ttr-toggle-sidebar").on("click", function () {
                    if ($("body").hasClass("ttr-opened-sidebar")) {
                        $("body").removeClass("ttr-opened-sidebar"), $("body").removeClass("ttr-body-fixed");
                    } else {
                        $(window).width() < 760 && $("body").addClass("ttr-body-fixed"), $("body").addClass("ttr-opened-sidebar");
                    }
                });

                $(".ttr-sidebar-pin-button").on("click", function () {
                    $("body").toggleClass("ttr-pinned-sidebar");
                });

                $(".ttr-sidebar-navi li.show > ul").slideDown(200);
                $(".ttr-sidebar-navi a").on("click", function (e) {
                    var a = $(this);
                    $(this).next().is("ul") ? (e.preventDefault(), a.parent().hasClass("show") ? (a.parent().removeClass("show"), a.next().slideUp(200)) : (a.parent().parent().find(".show ul").slideUp(200), a.parent().parent().find("li").removeClass("show"), a.parent().toggleClass("show"), a.next().slideToggle(200))) : (a.parent().parent().find(".show ul").slideUp(200), a.parent().parent().find("li").removeClass("show"), a.parent().addClass("show"))
                });

            };

            var waveEffect = function (e, a) {
                var s = ".ttr-wave-effect",
                    n = e.outerWidth(),
                    t = a.offsetX,
                    i = a.offsetY;
                e.prepend('<span class="ttr-wave-effect"></span>'), $(s).css({
                    top: i,
                    left: t
                }).animate({
                    opacity: "0",
                    width: 2 * n,
                    height: 2 * n
                }, 500, function () {
                    e.find(s).remove()
                });
            };

            var materialButton = function () {
                $(".ttr-material-button").on("click", function (e) {
                    waveEffect($(this), e)
                });
            }

            var headerSubMenu = function () {
                $(".ttr-header-submenu").show();
                $(".ttr-header-submenu").parent().find("a:first").on("click", function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    $(this).parents(".ttr-header-navigation").find(".ttr-header-submenu").not($(this).parents("li").find(".ttr-header-submenu")).removeClass("active");
                    $(this).parents("li").find(".ttr-header-submenu").show().toggleClass("active");
                });
                $(document).on("click", function (e) {
                    var a = $(e.target);
                    !0 === $(".ttr-header-submenu").hasClass("active") && !a.hasClass("ttr-submenu-toggle") && a.parents(".ttr-header-submenu").length < 1 && $(".ttr-header-submenu").removeClass("active"), a.parents(".ttr-search-bar").length < 1 && !a.hasClass("ttr-search-bar") && !a.parent().hasClass("ttr-search-toggle") && !a.hasClass("ttr-search-toggle") && $(".ttr-search-bar").removeClass("active")
                });
            }

            var displayGraph = function (dataset) {
                if (!checkSelectorExistence('#chart')) { return; }
                Chart.defaults.global.defaultFontFamily = "rubik";
                Chart.defaults.global.defaultFontColor = '#999';
                Chart.defaults.global.defaultFontSize = '12';

                var ctx = document.getElementById('chart').getContext('2d');

                const chart_data = init_data('Views', 'rgba(0,0,0,0.05)', '#FFCC00', '3', [200, 250, 300, 350, 300, 250, 200, 250, 300, 200, 200, 200], '#fff', '#fff');
                var chart = new Chart(ctx, {
                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                        // Information about the dataset
                        datasets: chart_data
                    },

                    // Configuration options
                    options: {

                        layout: {
                            padding: 0,
                        },

                        legend: { display: false },
                        title: { display: false },

                        scales: {
                            yAxes: [{
                                scaleLabel: {
                                    display: false
                                },
                                gridLines: {
                                    borderDash: [6, 6],
                                    color: "#ebebeb",
                                    lineWidth: 1,
                                },
                            }],
                            xAxes: [{
                                scaleLabel: { display: false },
                                gridLines: { display: false },
                            }],
                        },

                        tooltips: {
                            backgroundColor: '#333',
                            titleFontSize: 12,
                            titleFontColor: '#fff',
                            bodyFontColor: '#fff',
                            bodyFontSize: 12,
                            displayColors: false,
                            xPadding: 10,
                            yPadding: 10,
                            intersect: false
                        }
                    },
                });

            }

            return {
                initialHelper: function () {
                    searchToggle();
                    closeNav();
                    leftSidebar();
                    materialButton();
                    headerSubMenu();
                    displayGraph();
                }
            }

        }(jQuery);

        /* jQuery ready  */
        jQuery(document).on('ready', function () { AdminBuilder.initialHelper(); });
    })(jQuery);
</script>
<script src='assets/vendors/calendar/moment.min.js'></script>
<script src='assets/vendors/calendar/fullcalendar.js'></script>
<!-- <script src='assets/vendors/switcher/switcher.js'></script> -->
<script>
    $(document).ready(function () {

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listWeek'
            },
            defaultDate: '2019-03-12',
            navLinks: true, // can click day/week names to navigate views

            weekNumbers: true,
            weekNumbersWithinDays: true,
            weekNumberCalculation: 'ISO',

            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: [
                {
                    title: 'All Day Event',
                    start: '2019-03-01'
                },
                {
                    title: 'Long Event',
                    start: '2019-03-07',
                    end: '2019-03-10'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2019-03-09T16:00:00'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: '2019-03-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2019-03-11',
                    end: '2019-03-13'
                },
                {
                    title: 'Meeting',
                    start: '2019-03-12T10:30:00',
                    end: '2019-03-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2019-03-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2019-03-12T14:30:00'
                },
                {
                    title: 'Happy Hour',
                    start: '2019-03-12T17:30:00'
                },
                {
                    title: 'Dinner',
                    start: '2019-03-12T20:00:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2019-03-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2019-03-28'
                }
            ]
        });

    });

</script>
</body>

<!-- Mirrored from educhamp.themetrades.com/demo/admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Feb 2019 13:09:05 GMT -->

</html>