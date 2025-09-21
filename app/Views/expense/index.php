<?php
$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..') . $ds;
?>

<?php include("{$base_dir}{$ds}common/header.php"); ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/select2/select2.css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <?php include("{$base_dir}{$ds}common/sidebar.php"); ?>

      <!-- Layout container -->
      <div class="layout-page">
        <?php include("{$base_dir}{$ds}common/navbar.php"); ?>

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          <?php
          if ($segment == "") {
            include 'list.php';
          } elseif ($segment == "add") {
            include 'add.php';
          } elseif ($segment == "update") {
            include 'add.php';
          } elseif ($segment == "view") {
            include 'view.php';
          } elseif ($segment == "category") {
            include 'category.php';
          } elseif ($segment == "category_add" || $segment == "category_update") {
            include 'category_add.php';
          } else {
            include 'list.php';
          }
          ?>

          <!-- / Content -->

          <?php include("{$base_dir}{$ds}common/footer.php"); ?>

          <script src="<?php echo base_url(); ?>/public/assets/js/expense.js"></script>
          <script>
            expense.listing();
            expense.category_list();
          </script>
<?php if ($segment == "view") { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>/public/assets/vendor/libs/apex-charts/apex-charts.css" />
<script src="<?php echo base_url(); ?>/public/assets/vendor/libs/apex-charts/apexcharts.js"></script>

<script>
$( document ).ready(function() {
  let cardColor, headingColor, labelColor, borderColor, legendColor;

  if (isDarkStyle) {
    cardColor = config.colors_dark.cardColor;
    headingColor = config.colors_dark.headingColor;
    labelColor = config.colors_dark.textMuted;
    legendColor = config.colors_dark.bodyColor;
    borderColor = config.colors_dark.borderColor;
  } else {
    cardColor = config.colors.cardColor;
    headingColor = config.colors.headingColor;
    labelColor = config.colors.textMuted;
    legendColor = config.colors.bodyColor;
    borderColor = config.colors.borderColor;
  }

  // Color constant
  const chartColors = {
    column: {
      series1: '#826af9',
      series2: '#d2b0ff',
      bg: '#f8d3ff'
    },
    donut: {
      series1: '#fee802',
      series2: '#3fd0bd',
      series3: '#826bf8',
      series4: '#2b9bf4'
    },
    area: {
      series1: '#29dac7',
      series2: '#60f2ca',
      series3: '#a5f8cd'
    }
  };

  // Horizontal Bar Chart
  // --------------------------------------------------------------------
  const horizontalBarChartEl = document.querySelector('#horizontalBarChart'),
    horizontalBarChartConfig = {
      chart: {
        height: 400,
        type: 'bar',
        toolbar: {
          show: false
        }
      },
      plotOptions: {
        bar: {
          horizontal: false,
          barHeight: '30%',
          startingShape: 'rounded',
          borderRadius: 8
        }
      },
      grid: {
        borderColor: borderColor,
        xaxis: {
          lines: {
            show: false
          }
        },
        padding: {
          top: -20,
          bottom: -12
        }
      },
      colors: config.colors.info,
      dataLabels: {
        enabled: false
      },
      series: [
        {
          data: [<?php echo implode(',',$ExpenseChartData['X']); ?>]
        }
      ],
      xaxis: {
        categories: [<?php echo "'" .implode ( "', '", $ExpenseChartData['Y']) . "'"; ?>],
        axisBorder: {
          show: false
        },
        axisTicks: {
          show: false
        },
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      },
      yaxis: {
        labels: {
          style: {
            colors: labelColor,
            fontSize: '13px'
          }
        }
      }
    };
    const horizontalBarChart = new ApexCharts(horizontalBarChartEl, horizontalBarChartConfig);
    horizontalBarChart.render();

});
</script>

<?php } ?>