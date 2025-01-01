import dayjs from "@/dayjs";
const timezone = Intl.DateTimeFormat().resolvedOptions().timeZone;

export default {
    getUserTimezone() {
        return Intl.DateTimeFormat().resolvedOptions().timeZone;
    },

    formatDate(date) {
        return dayjs.utc(date).tz(timezone).format("MMM D, YYYY");
    },

    formatDateTime(date) {
        return dayjs.utc(date).tz(timezone).format("MMM D, YYYY h:mm A");
    },

    diffForHumans(date) {
        let localDate = dayjs
            .utc(date)
            .tz(timezone)
            .format("YYYY-MM-DD HH:mm:ss");
        return dayjs().to(dayjs(localDate));
    },

    formatResponseDelay(seconds) {
        return dayjs().add(seconds, "seconds").fromNow(true);
    },
};
