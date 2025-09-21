/**
 * App Calendar Events
 */

'use strict';

let date = new Date();
let nextDay = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
// prettier-ignore
let nextMonth = date.getMonth() === 11 ? new Date(date.getFullYear() + 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() + 1, 1);
// prettier-ignore
let prevMonth = date.getMonth() === 11 ? new Date(date.getFullYear() - 1, 0, 1) : new Date(date.getFullYear(), date.getMonth() - 1, 1);

let events = [
  {
    id: 1,
    url: '',
    title: 'Doctor Appointment',
    start: date,
    end: nextDay,
    allDay: false,
    extendedProps: {
      calendar: 'Upcomming'
    }
  },
  {
    id: 2,
    url: '',
    title: 'Doctor Appointment',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
    allDay: true,
    extendedProps: {
      calendar: 'Upcomming'
    }
  },
  {
    id: 3,
    url: '',
    title: 'Doctor Appointment',
    allDay: true,
    start: new Date(date.getFullYear(), date.getMonth() + 1, -9),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -7),
    extendedProps: {
      calendar: 'Holiday'
    }
  },
  {
    id: 4,
    url: '',
    title: "Doctor Appointment",
    start: new Date(date.getFullYear(), date.getMonth() + 1, -11),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -10),
    extendedProps: {
      calendar: 'Cancel'
    }
  },
  {
    id: 5,
    url: '',
    title: 'Doctor Appointment',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    allDay: true,
    extendedProps: {
      calendar: 'Pending'
    }
  },
  {
    id: 6,
    url: '',
    title: 'Doctor Appointment',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    allDay: true,
    extendedProps: {
      calendar: 'Cancel'
    }
  },
  {
    id: 7,
    url: '',
    title: 'Doctor Appointment',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    extendedProps: {
      calendar: 'Rejected'
    }
  },
  {
    id: 8,
    url: '',
    title: 'Doctor Appointment',
    start: new Date(date.getFullYear(), date.getMonth() + 1, -13),
    end: new Date(date.getFullYear(), date.getMonth() + 1, -12),
    allDay: true,
    extendedProps: {
      calendar: 'Upcomming'
    }
  },
  {
    id: 9,
    url: '',
    title: 'Doctor Appointment',
    start: nextMonth,
    end: nextMonth,
    allDay: true,
    extendedProps: {
      calendar: 'Upcomming'
    }
  },
  {
    id: 10,
    url: '',
    title: 'Doctor Appointment',
    start: prevMonth,
    end: prevMonth,
    allDay: true,
    extendedProps: {
      calendar: 'Cancel'
    }
  }
];
