import toasts from "../../../mixins/toasts";
export default {
  namespaced: true,

  state() {
    return {
      // ---------- main
      images: [],
      dialog: false,
      saveDialog: false,
      activeVariation: {
         id: '',
        color_id: '',
        size_id: '',
 
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
        variation_id : '' ,
        variation: {
          id: '',
        },

        image : '',
        color_id : '',
        size_id : ''


      },
      defaultItem: {
        id: '',
        variation_id : '' ,
        variation: {
          id: '',
        },

        image : '',
        color_id : '',
        size_id : ''


      },

      image: {
        file: '',
        name: '',
        preview: '',
      },

      defaultImage: {
        file: '',
        name: '',
        preview: '',
      },

      // ---------- dialog data
    }
  },

  getters: {
    getImage: (state) => {
      let dynamicData
      if (state.image.preview) {
        dynamicData = state.image.preview
      } else if (state.editedItem.image) {
        dynamicData =  state.editedItem.image
      } else {
        dynamicData =
          '/images/products/variations/variation.jpg'
      }

      return dynamicData
    },

    formTitle: (state) => {
      return state.editedIndex === -1
        ? 'Add new image'
        : 'Update image'
    },


    getImageParagraph: (state) => {
      if (state.errors.hasOwnProperty('image')) {
        return `<span class = 'error-paragraph'>  ${state.errors.image[0]}  </span> `
      }  else if (state.image.name) {
        return `<span class = 'paragraph'>  ${state.image.name}  </span> `
      } else {
        return `<span class = 'paragraph'> no image selected </span> `
      }
    },

  },

  mutations: {
    // ---------- main
    assignApiData: (state, images) => {
      state.images = images
    },

    manageImages: (state, item) => {
      state.activeVariation = Object.assign({}, item)
      state.dialog = true
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

      setTimeout(() => {
        state.editedItem = Object.assign({}, state.defaultItem)
        state.image = Object.assign({}, state.defaultImage)
        state.editedIndex = -1;
    }, 500);
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

    imageSelected: (state, element) => {
      state.image.file = element.target.files[0]
      state.image.name = element.target.files[0].name
      let reader = new FileReader()
      reader.readAsDataURL(state.image.file)
      reader.onload = (element) => {
        state.image.preview = element.target.result
      }
    },

    // ---------- dialog data ---------------------------
  },

  actions: {


    closeDialogAction({commit }) {
      commit('closeDialog');
      setTimeout (()=> { 
        commit("variations/closeData", null, { root: true });
      }  , 200)
    

    },


    async delete({ state, dispatch, commit }) {

      console.log(state.deleteIndex)
      commit('closeDeleteSnackbar')
      const Data = await axios
        .delete(`/variationImage/${state.deleteIndex}`)
        .catch((error) => {
          toasts.methods.fireErrorToast()
        })

      if (Data) {
        const DATAFETCHED = await  dispatch('products/fetch', null, { root: true })
        toasts.methods.fireSuccessToast('Record deleted successfully')
      }
    },



  async  save({ state, commit, getters, dispatch }) {
      commit('intializeSave')

      let variationImageData = new FormData()
      variationImageData.append('image', state.image.file)
      variationImageData.append('variation_id', state.activeVariation.id)
      variationImageData.append('color_id', state.activeVariation.color_id)
      variationImageData.append('size_id', state.activeVariation.size_id)
      variationImageData.append('id', state.editedItem.id)
      if (state.editedIndex === -1) {
        const Data = await axios
        .post(`/variationImage/store`, variationImageData)
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
        .post(`/variationImage/update/${state.editedIndex}`, variationImageData)
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
