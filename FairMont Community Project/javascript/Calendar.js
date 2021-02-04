/*	
	Author: Will Duffy
	Date:   12/10/2018
	File: Calendar.js
*/

function calendar(calendarDay) {
	if (calendarDay == null) calDate=new Date()
	else calDate = new Date(calendarDay);
	
	document.write("<table id='calendar_table'>");
	writeCalTitle(calDate);
	writeDayNames();
	writeCalDays(calDate);
	document.write("</table>");
}

function writeCalTitle(calendarDay) {
	var monthName = new Array("January", "February", "March", "April",
	"May", "June", "July", "August", "September", "October", "November",
	"December");
	
	var thisMonth=calendarDay.getMonth();
	var thisYear=calendarDay.getFullYear();
	
	document.write("<tr>");
	document.write("<th id='calendar_head' colspan='7'>");
	document.write(monthName[thisMonth]+" "+thisYear);
	document.write("</th>");
	document.write("</tr>");
}


function writeDayNames() {
	var dayName = new Array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
	document.write("<tr>");
	for (var i = 0;i < dayName.length;i++) {
		document.write("<th class='calendar_weekdays'> "+dayName[i]+"</th>");
	}
	document.write("</tr>");
}

function daysInMonth(calendarDay) {
	var thisYear = calendarDay.getFullYear();
	var thisMonth = calendarDay.getMonth();
	var dayCount = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
	
	if (thisYear % 4 == 0) {
		if ((thisYear % 100 != 0) || (thisYear % 400 == 0)) {
			dayCount[1] = 29;
		}
	}
	
	return dayCount[thisMonth];
}

function writeCalDays(calendarDay) {
	var currentDay = calendarDay.getDate();
	
	var dayCount = 1;
	var totalDays = daysInMonth(calendarDay);
	calendarDay.setDate(1);
	var weekDay = calendarDay.getDay();
	
	document.write("<tr>");
	for (var i=0; i < weekDay; i++) {
		document.write("<td></td>");
	}
	while (dayCount <= totalDays) {
		
		if (weekDay == 0) document.write("</tr>");
		if (dayCount == currentDay) {
			document.write("<td class='calendar_dates' id='calendar_today'>"+dayCount+"</td>");
		} else {
			document.write("<td class='calendar_dates'>"+dayCount+"</td>");
		}
		
		if (weekDay == 6) document.write("</tr>");
		
		dayCount++;
		calendarDay.setDate(dayCount);
		weekDay = calendarDay.getDay();
		
	}
	
	document.write("</tr>");
}