const date = new Date();

const renderCalendar = () => {
  const monthDays = document.querySelector(".days");

  const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

  const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();

  const firstDayIndex = (date.getDay() + 3) % 7;

  const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();

  const nextDays = 7 - lastDayIndex - 1;

  const months = [
    "January",
    "February",
    "March",
    "April",
    "May",
    "June",
    "July",
    "August",
    "September",
    "October",
    "November",
    "December",
  ];

  // Selected month
  document.querySelector(".date h1").innerHTML = months[date.getMonth()];

  //cCurrent date
  document.querySelector(".date p").innerHTML = new Date().toDateString();

  let days = "";

  //pPrev month days
  for (let x = firstDayIndex; x > 0; x--) {
    let tempPrev = [date.getFullYear().toString(), [('00' + date.getMonth()).slice(-2)], [('00' + (prevLastDay - x + 1)).slice(-2)].toString()].join('-');
    if (dates.indexOf(tempPrev) > -1) {
      days += `<input class="prev-date eventB" type="submit" name="event" value="${prevLastDay - x + 1}"/>`
    } else {
      days += `<input class="prev-date" type="submit" name="empty" value="${prevLastDay - x + 1}"/>`
    }
  }

  // Current month days
  for (let i = 1; i <= lastDay; i++) {
    let tempDate = [date.getFullYear().toString(), [('00' + (date.getMonth() + 1)).slice(-2)], [('00' + i).slice(-2)].toString()].join('-');
    if (i === new Date().getDate() && date.getMonth() === new Date().getMonth() && date.getFullYear() === new Date().getFullYear()) {
      if (dates.indexOf(tempDate) > -1) {
        days += `<input class="today" type="submit" name="event" value="${i}"/">`;
      } else {
        days += `<input class="today" type="submit" value="${i}"/">`;
      }
    } else {
      if (dates.indexOf(tempDate) > -1) {
        days += `<input class="eventB" type="submit" name="event" value="${i}"/>`;
      } else {
        days += `<input type="submit" name="empty" value="${i}"/>`;
      }
    }
  }

  // Next month days
  for (let j = 1; j <= nextDays; j++) {
    tempNext = [date.getFullYear().toString(), [('00' + (date.getMonth() + 2)).slice(-2)], [('00' + (j)).slice(-2)].toString()].join('-');
    if (dates.indexOf(tempNext) > -1) {
      days += `<input class="next-date eventB" type="submit" name="event" value="${j}"/>`;
    } else {
      days += `<input class="next-date" type="submit" name="empty" value="${j}"/>`;
    }
  }
  monthDays.innerHTML = days;
}

// Moves the month back
document.querySelector(".prev").addEventListener('click', () => {
  date.setMonth(date.getMonth() - 1);
  renderCalendar();
})

// Moves the month forward
document.querySelector(".next").addEventListener('click', () => {
  date.setMonth(date.getMonth() + 1);
  renderCalendar();
})



renderCalendar();
