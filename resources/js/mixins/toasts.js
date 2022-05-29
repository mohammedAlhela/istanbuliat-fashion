

export default {
  methods: {
    fireSuccessToast: (message) => {
        Toast.fire({
            icon: "success",
            title: message ,

        });
    },

    fireErrorToast: (message = 'Obs something went error on the server' ) => {
        Toast.fire({
            icon: "error",
            title: message

        });
    },

    fireWarningToast: (message = 'Obs something went error on the server') => {
        Toast.fire({
            icon: "warning",
            title: message ,
            // timer: 1000000,
        });
    },

  },
}
