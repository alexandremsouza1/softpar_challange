import { createStore } from 'vuex';
import createPersistedState from 'vuex-persistedstate';

export default createStore({
  state: {
    accessToken: null,
  },
  getters: {
    isAuthenticated(state) {
      return !!state.accessToken;
    },
  },
  mutations: {
    setAccessToken(state, token) {
      state.accessToken = token;
    },
    clearAccessToken(state) {
      state.accessToken = null; 
    },
  },
  actions: {
    updateAccessToken({ commit }, token) {
      commit('setAccessToken', token);
    },
    logout({ commit }) {
      commit('clearAccessToken');
    },
  },
  modules: {},
  plugins: [
    createPersistedState({
      key: 'softpar',
      storage: localStorage,
      paths: ['accessToken'], 
    }),
  ],
});
