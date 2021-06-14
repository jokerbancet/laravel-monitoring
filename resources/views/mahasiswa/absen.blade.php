@extends('layouts.layout_master')
@section('main_content2')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel">
                <h3 class="panel-heading" id="monthAndYear"></h3>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive-sm" id="calendar">
                        <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        </thead>
                        <tbody id="calendar-body">
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <div class="form-inline" style="margin-bottom: 20px">
                        <button class="btn btn-primary col-sm-6" id="previous" onclick="previous()">Previous</button>
                        <button class="btn btn-primary col-sm-6" id="next" onclick="next()">Next</button>
                    </div><br>
                    <form class="form-inline" >
                        <label class="lead" for="month" style="margin-top: 10px; display: inline">Loncat ke: </label>
                        <select class="form-control col-sm-4" name="month" id="month" onchange="jump()">
                            <option value=0>Jan</option>
                            <option value=1>Feb</option>
                            <option value=2>Mar</option>
                            <option value=3>Apr</option>
                            <option value=4>May</option>
                            <option value=5>Jun</option>
                            <option value=6>Jul</option>
                            <option value=7>Aug</option>
                            <option value=8>Sep</option>
                            <option value=9>Oct</option>
                            <option value=10>Nov</option>
                            <option value=11>Dec</option>
                        </select>
                        <label for="year"></label>
                        <select class="form-control col-sm-4" name="year" id="year" onchange="jump()">
                            <option value=1990>1990</option>
                            <option value=1991>1991</option>
                            <option value=1992>1992</option>
                            <option value=1993>1993</option>
                            <option value=1994>1994</option>
                            <option value=1995>1995</option>
                            <option value=1996>1996</option>
                            <option value=1997>1997</option>
                            <option value=1998>1998</option>
                            <option value=1999>1999</option>
                            <option value=2000>2000</option>
                            <option value=2001>2001</option>
                            <option value=2002>2002</option>
                            <option value=2003>2003</option>
                            <option value=2004>2004</option>
                            <option value=2005>2005</option>
                            <option value=2006>2006</option>
                            <option value=2007>2007</option>
                            <option value=2008>2008</option>
                            <option value=2009>2009</option>
                            <option value=2010>2010</option>
                            <option value=2011>2011</option>
                            <option value=2012>2012</option>
                            <option value=2013>2013</option>
                            <option value=2014>2014</option>
                            <option value=2015>2015</option>
                            <option value=2016>2016</option>
                            <option value=2017>2017</option>
                            <option value=2018>2018</option>
                            <option value=2019>2019</option>
                            <option value=2020>2020</option>
                            <option value=2021>2021</option>
                            <option value=2022>2022</option>
                            <option value=2023>2023</option>
                            <option value=2024>2024</option>
                            <option value=2025>2025</option>
                            <option value=2026>2026</option>
                            <option value=2027>2027</option>
                            <option value=2028>2028</option>
                            <option value=2029>2029</option>
                            <option value=2030>2030</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
    integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
    crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
    integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
    crossorigin="anonymous"></script>
    <script>
        $('#absen-ku').addClass('active');
        let today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();
        let selectYear = document.getElementById("year");
        let selectMonth = document.getElementById("month");

        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        let monthAndYear = document.getElementById("monthAndYear");
        showCalendar(currentMonth, currentYear);


        function next() {
            currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
            currentMonth = (currentMonth + 1) % 12;
            showCalendar(currentMonth, currentYear);
        }

        function previous() {
            currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
            currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
            showCalendar(currentMonth, currentYear);
        }

        function jump() {
            currentYear = parseInt(selectYear.value);
            currentMonth = parseInt(selectMonth.value);
            showCalendar(currentMonth, currentYear);
        }

        function showCalendar(month, year) {
            var absenan;
            var mulai_magang,selesai_magang;
            // Ajax laporan data
            $.ajax({
                url: '',
                async: false,
                data: {month,year},
                success: function(result){
                    absenan = result.absen
                    mulai_magang = result.pemagang.mulai_magang
                    selesai_magang = result.pemagang.selesai_magang
                }
            });

            let firstDay = (new Date(year, month)).getDay();
            let daysInMonth = 32 - new Date(year, month, 32).getDate();

            let tbl = document.getElementById("calendar-body"); // body of the calendar

            // clearing all previous cells
            tbl.innerHTML = "";

            // filing data about month and in the page via DOM.
            monthAndYear.innerHTML = months[month] + " " + year;
            selectYear.value = year;
            selectMonth.value = month;

            // creating all cells
            let date = 1;
            let bulan,hari;
            for (let i = 0; i < 6; i++) {
                // creates a table row
                let row = document.createElement("tr");

                //creating individual cells, filing them up with data.
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        let cell = document.createElement("td");
                        let cellText = document.createTextNode("");
                        cell.appendChild(cellText);
                        row.appendChild(cell);
                    }
                    else if (date > daysInMonth) {
                        break;
                    }

                    else {
                        bulan = ('0'+month).substr(('0'+month).length-2,('0'+month).length);
                        hari = ('0'+date).substr(('0'+date).length-2,('0'+date).length);
                        let tanggal_sebelumnya = year+'-'+bulan+'-'+hari;
                        bulan = ('0'+today.getMonth()).substr(('0'+today.getMonth()).length-2,('0'+today.getMonth()).length);
                        hari = ('0'+today.getDate()).substr(('0'+today.getDate()).length-2,('0'+today.getDate()).length);
                        let tanggal_sekarang = today.getFullYear()+'-'+bulan+'-'+hari;
                        let cell = document.createElement("td");
                        let cellText = document.createTextNode(date);
                        if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            cell.classList.add("bg-info"); cell.style.color = 'green';// color today's date
                        } else if(tanggal_sebelumnya<tanggal_sekarang){
                            let bulan = ('0'+(month+1)).substr(('0'+(month+1)).length-2,('0'+(month+1)));
                            let hari = ('0'+(date)).substr(('0'+(date)).length-2,('0'+(date)));
                            let tanggal = year+'-'+bulan+'-'+hari;
                            bulan = ('0'+(month+1)).substr(('0'+(month+1)).length-2,('0'+(month+1)).length);
                            hari = ('0'+date).substr(('0'+date).length-2,('0'+date).length);
                            let tanggal_sebelumnya = year+'-'+bulan+'-'+hari;
                            cell.style.color = 'white';
                            if(absenan.includes(tanggal)){
                                cell.classList.add('bg-success')
                            }else if(mulai_magang<=tanggal_sebelumnya&&tanggal_sebelumnya<=selesai_magang){
                                cell.classList.add('bg-danger')
                            }else{cell.style.color = 'black'}
                        }else if(tanggal_sebelumnya<=selesai_magang){
                            cell.style.color='blue'
                        }
                        cell.appendChild(cellText);
                        row.appendChild(cell);
                        date++;
                    }


                }

                tbl.appendChild(row); // appending each row into calendar body.
            }

        }
    </script>
@endpush