export default {
    truncString(str, max, add) {
        add = add || "...";
        return typeof str === "string" && str.length > max
            ? str.substring(0, max) + add
            : str;
    },
    formattedTime(dt) {
        const padL = (nr, len = 2, chr = `0`) => `${nr}`.padStart(2, chr);
        const format = `${dt.getFullYear()}-${padL(dt.getMonth() + 1)}-${padL(
            dt.getDate()
        )} ${padL(dt.getHours())}:${padL(dt.getMinutes())}:${padL(
            dt.getSeconds()
        )}`;
        return format;
    },
};
