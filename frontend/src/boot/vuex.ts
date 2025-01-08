import { defineBoot } from "#q-app/wrappers";
import { createStore } from "vuex";

import store from "../store";

export default defineBoot(({ app }) => {
    app.use(store);
});