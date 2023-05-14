<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
     google.load('visualization', '1.0', {'packages':['corechart']});
     google.setOnLoadCallback(drawVisualization);
     function drawVisualization() {
		 				//thống kê số lượng bán hàng theo mặt hàng vẽ bieu do tron
            // tạo bảng
            var data = new google.visualization.DataTable();
            var tenhh = new Array();
            var soluongban = new Array();
            var rows = new Array();
            var datahh = 0;
            var slban = 0;

            <?php
            if(isset($_POST['month'])){
              $month = date('m',strtotime($_POST['month']));
              $year = date('Y',strtotime($_POST['month']));
              $hh = new product();
              $result = $hh->getThongKe_MatHang($month,$year);
              while($set=$result->fetch()){
                $tensp = $set['tensp'];
                $soluong = $set['soluong'];
                echo "tenhh.push('".$tensp ."');";
                echo "soluongban.push('".$soluong."');";
              }
            }
            ?>
            // + dòng và cột
            for(var i=0;i<tenhh.length;i++)
            {
              datahh = tenhh[i];
              slban=parseInt(soluongban[i]);
              rows.push([datahh,slban]);
            }
            // tạo cột trong DataTable
            data.addColumn('string', "Hàng hóa");
            data.addColumn('number', "Số lượng bán");
            data.addRows(rows);
            // option
            var option={
              title: 'Thống kê số lượng bán hàng hóa',
              'width': 600,
              'height': 400,
              'backgroundColor': '#ffffff',
              
            };
            // ColumnChart, PieChart, BarChart, LineChart
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data,option);
	 }
   
   </script>
   <div id="chart_div">Thống kê</div>