<form id="monthStatistic" class="container">
    <label for="">Thống kê theo tháng</label>
    <input type="month" name="month" id="" class="form-control w-25">
    <button type="submit" class="btn btn-primary mt-2">Thống kê</button>
</form>
<canvas id="chart"></canvas>

<script>
    $(document).ready(function(){
        $.ajax({
            url: 'index.php?action=resolve&act=show-chart',
            dataType: 'json',
            success: function(data) {
                // Tạo biểu đồ bằng Chart.js
                var ctx = document.getElementById('chart').getContext('2d');
                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: data.map(function(d) {
                            return d.product_name;
                        }),
                        datasets: [{
                            label: 'Sản phẩm bán nhiều nhất',
                            data: data.map(function(d) {
                                return d.quantity;
                            }),
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        plugins: {
                            title: {
                                text: 'Chart.js Combo Time Scale',
                                display: true
                            }
                        },
                        scales: {
                            x: {
                                type: 'time',
                                display: true,
                                offset: true,
                                time: {
                                    unit: 'day'
                                }
                            },
                        },
                    },
                });
            }
        });
        // Gửi yêu cầu Ajax để lấy dữ liệu từ trang PHP
        $(document).on('submit','#monthStatistic',function(e){
            e.preventDefault()
            let formData = $(this).serialize()
            console.log(formData);
             // Gửi yêu cầu Ajax để lấy dữ liệu từ trang PHP
    $.ajax({
        url: 'index.php?action=resolve&act=show-chart',
        dataType: 'json',
        data:formData,
        method:'POST',
        success: function(data) {
            // Tạo biểu đồ bằng Chart.js
            var ctx = document.getElementById('chart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.map(function(d) {
                        return d.product_name;
                    }),
                    datasets: [{
                        label: 'Sản phẩm bán nhiều nhất',
                        data: data.map(function(d) {
                            return d.quantity;
                        }),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        title: {
                            text: 'Chart.js Combo Time Scale',
                            display: true
                        }
                    },
                    scales: {
                        x: {
                            type: 'time',
                            display: true,
                            offset: true,
                            time: {
                                unit: 'day'
                            }
                        },
                    },
                },
            });
        }
    });
        })
    })
    
</script>