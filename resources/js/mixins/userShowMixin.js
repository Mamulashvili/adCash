import { HTTP } from "@utils/HTTP";

export const userShowMixin = {
  props: {
    itemId: {
      type: Number,
      required: true,
      default: 1,
    },
  },

  data() {
    return {
      showUser: null,
    };
  },

  created() {
    this.getUser();
  },

  methods: {
    getUser: function () {
      HTTP.get(`/users/${this.itemId}`)
        .then(({ data }) => {
          console.log(data);
          this.showUser = data;
        })
        .catch((e) => {
          alert("Something went wrong 😔");
          console.log(e);
        });
    },
  },
};