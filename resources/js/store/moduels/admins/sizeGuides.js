import toasts from "../../../mixins/toasts";
export default {
  namespaced: true,

  state() {
    return {
      // ---------- main
      dialog: false,
      saveDialog: false,
      activeProduct: {
      },
      // ---------- main

      // ---------- delete
      singleDelete: true,
      deleteSnackbar: false,
      deleteIndex: -1,
      // ---------- delete

      // ---------- dialog data
      buttonLoading: false,
      errors: {},
      editedIndex: -1,
      editedItem: {
        id: '',
        product_id : '' ,
       size : { 
        id : "",

        name : ""
       },
        product_name : '' ,
        size_name : '' ,
        shoulder : '' ,
        bust : '' ,
        wist : '' ,
        hip : '' ,
        length : '' ,
      
      },
      defaultItem: {
        id: '',
        product_id : '' ,
        size : { 
  id : "",

  name : ""
        },
        product_name : '' ,
        size_name : '' ,
        shoulder : '' ,
        bust : '' ,
        wist : '' ,
        hip : '' ,
        length : '' ,
      },



      // ---------- dialog data
    }
  },

  getters: {
 
    formTitle: (state) => {
      return state.editedIndex === -1
        ? 'Add new Size Guide'
        : 'Update Size Guide'
    },

  },

  mutations: {
    // ---------- main
    manageSizeGuides: (state, item) => {
      state.activeProduct = Object.assign({}, item)
      state.dialog = true

   state.sizes = state.activeProduct.sizes.split(",");
    },
    // ---------- main

    // ---------- delete
    closeDeleteSnackbar: (state) => {
      state.deleteSnackbar = false
    },
    showDeleteSnackbar: (state, item) => {
      state.deleteIndex = item.id
      state.deleteSnackbar = true
    },
    // ---------- delete

    // ---------- dialog data --------------------------------
    closeDialog: (state) => {
      state.dialog = false
    },

    closeData: (state) => {
      state.saveDialog = false
      state.buttonLoading = false
      state.errors = {}
      state.editedItem = Object.assign({}, state.defaultItem)
      state.editedIndex = -1
    },

    editItem: (state, item) => {
      state.editedIndex = item.id
      state.editedItem = Object.assign({}, item)
      state.saveDialog = true
    },

    intializeSave: (state) => {
      state.errors = {}
      state.buttonLoading = true
    },

    openSaveDialog: (state) => {
      state.saveDialog = true
    },

    fillDialogErrors: (state, erros) => {
      state.errors = erros
      state.buttonLoading = false
    },

    setDialogValues: (state, dataObject) => {
      if (dataObject.variableType === 'size') {
          state.editedItem.size = Object.assign({}, dataObject.e )
      } else if (dataObject.variableType === 'length') {
        state.editedItem.length = dataObject.e
      } else if (dataObject.variableType === 'hip') {
        state.editedItem.hip = dataObject.e
      } else if (dataObject.variableType === 'wist') {
        state.editedItem.wist = dataObject.e
      } else if (dataObject.variableType === 'bust') {
        state.editedItem.bust = dataObject.e
      } else if (dataObject.variableType === 'shoulder') {
        state.editedItem.shoulder = dataObject.e
      }
    },



    // ---------- dialog data ---------------------------
  },

  actions: {


     closeDialogAction({commit }) {
      commit('closeDialog');
      setTimeout (()=> { 
        commit("products/closeData", null, { root: true });
      }  , 200)

    },

    async delete({ state, dispatch, commit }) {
      commit('closeDeleteSnackbar')
      const Data = await axios
        .delete(`/sizeGuide/${state.deleteIndex}`)
        .catch((error) => {
          toasts.methods.fireErrorToast()
        })

      if (Data) {
        const DATAFETCHED = await  dispatch('products/fetch', null, { root: true })
        toasts.methods.fireSuccessToast('Record deleted successfully')
      }
    },

  async  save({ state, commit, dispatch }) {
      commit('intializeSave')

      let sizeGuideData = new FormData()
      sizeGuideData.append('id', state.editedItem.id)
      sizeGuideData.append('size_name', state.editedItem.size.name)
      sizeGuideData.append('size_id', state.editedItem.size.id)
      sizeGuideData.append('product_name', state.activeProduct.name)
      sizeGuideData.append('product_id', state.activeProduct.id)
      sizeGuideData.append('shoulder', state.editedItem.shoulder)
      sizeGuideData.append('bust', state.editedItem.bust)
      sizeGuideData.append('wist', state.editedItem.wist)
      sizeGuideData.append('hip', state.editedItem.hip)
      sizeGuideData.append('length', state.editedItem.length)

      if (state.editedIndex === -1) {
        const Data = await axios
        .post(`/sizeGuide/store`, sizeGuideData)
        .catch((error) => {
          commit('fillDialogErrors', error.response.data.errors)
        })

      if (Data) {
        const DATAFETCHED = await  dispatch('products/fetch', null, { root: true })
        commit('closeData')
        toasts.methods.fireSuccessToast('Record added successfully')
      }
      } else {
        const Data = await axios
        .post(`/sizeGuide/update/${state.editedIndex}`, sizeGuideData)
        .catch((error) => {
          commit('fillDialogErrors', error.response.data.errors)
        })

      if (Data) {
        const DATAFETCHED = await  dispatch('products/fetch', null, { root: true })
        commit('closeData')
        toasts.methods.fireSuccessToast('Record updated successfully')
      }
      }
    },
  },
}
