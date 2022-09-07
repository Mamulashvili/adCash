import { HTTP } from "@utils/HTTP";

export const stockShowMixin = {
  props: {
    stockId: {
      type: Number,
      required: true,
      default: 1,
    },
  },

  data() {
    return {
      showStock: null,
    };
  },

  created() {
    this.getStock();
  },

  methods: {
    getStock: function () {
      HTTP.get(`/stock/show/${this.stockId}`)
        .then(({ data }) => {
          this.showStock = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },
  },
};