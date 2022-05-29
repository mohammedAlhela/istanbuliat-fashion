import toasts from "../../../mixins/toasts";
export default {
  namespaced: true,

  state() {
    return {
      // ---------- main
      dialog: false,
      saveDialog: false,
      activeProduct: {
        id: '',
        name: '',
        variations: [],
      },
      variations: [],
      // ---------- main

      // ---------- delete
      singleDelete: true,
      deleteSnackbar: false,
      deleteIndex: -1,
      // ---------- delete

      // ---------- dialog data
      buttonLoading: false,
      errors: {},
      dialog: false,
      editedIndex: -1,
      editedItem: {
        id: '',
        color: {
          id: '',
          name: '',
        },

        size: {
          id: '',
          name: '',
        },

        selling_price: 0,
        discount_price: 0,

        stock_qty: 0,
      },
      defaultItem: {
        id: '',
        color: {
          id: '',
          name: '',
        },

        size: {
          id: '',
          name: '',
        },

        selling_price: 0,
        discount_price: 0,

        stock_qty: 0,
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
        ? 'Add new product variation'
        : 'Update product variation data'
    },

    datatableIndex: (state) => {
      if (state.editedIndex > -1) {
        return state.activeProduct.variations.findIndex(function (variation) {
          return variation.id == state.editedIndex
        })
      }
      return 0
    },

    getVariations: (state) => {
      if (state.editedIndex > -1) {
        return state.activeProduct.variations.findIndex(function (variation) {
          return variation.id == state.editedIndex
        })
      }
      return 0
    },


    getImageParagraph: (state) => {
      if (state.errors.hasOwnProperty('image')) {
        return `<span class = 'error-paragraph'>  ${state.errors.image[0]}  </span> `
      } else if (state.editedItem.imageName) {
        return `<span class = 'paragraph'>  ${state.editedItem.imageName}  </span> `
      } else if (state.image.name) {
        return `<span class = 'paragraph'>  ${state.image.name}  </span> `
      } else {
        return `<span class = 'paragraph'> no image selected </span> `
      }
    },

  },

  mutations: {
    // ---------- main
    manageVariations: (state, item) => {
      state.variation = item.variation
      state.activeProduct = item
      state.dialog = true
    },

    assignApiData: (state, variations) => {
      state.variations = variations
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

    removeDeletedVariation: (state) => {
      state.activeProduct.variations = state.activeProduct.variations.filter(
        (variation) => {
          return variation.id != state.deleteIndex
        }
      )
      state.deleteIndex = -1
      toasts.methods.fireSuccessToast('Record deleted successfully')
    },
    // ---------- delete

    // ---------- dialog data --------------------------------

    setDialogValues: (state, dataObject) => {
      if (dataObject.variableType === 'color') {
        state.editedItem.color = dataObject.e
      } else if (dataObject.variableType === 'selling_price') {
        state.editedItem.selling_price = dataObject.e
      } else if (dataObject.variableType === 'discount_price') {
        state.editedItem.discount_price = dataObject.e
      } else if (dataObject.variableType === 'size') {
        state.editedItem.size = dataObject.e
      } else if (dataObject.variableType === 'stock_qty') {
        state.editedItem.stock_qty = dataObject.e
      }
    },

    closeDialog: (state) => {
      state.dialog = false
    },

    closeData: (state) => {
      state.saveDialog = false
      state.buttonLoading = false
      state.errors = {}
      state.editedItem = Object.assign({}, state.defaultItem)
      state.image = Object.assign({}, state.defaultImage)
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
      state.editedItem.product_id = state.activeProduct.id
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

    async delete({ state, dispatch, commit }) {
      commit('closeDeleteSnackbar')
      const Data = await axios
        .delete(`/variation/${state.deleteIndex}`)
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

      let variationData = new FormData()
      variationData.append('image', state.image.file)
      variationData.append('product_id', state.activeProduct.id)
      variationData.append('color_id', state.editedItem.color.id)
      variationData.append('size_id', state.editedItem.size.id)

      variationData.append('selling_price', state.editedItem.selling_price)
      variationData.append('discount_price', state.editedItem.discount_price)
      variationData.append('stock_qty', state.editedItem.stock_qty)

      variationData.append('id', state.editedItem.id)
      if (state.editedIndex === -1) {
        const Data = await axios
        .post(`/variation/store`, variationData)
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
        .post(`/variation/update/${state.editedIndex}`, variationData)
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


    manageImages({ state, commit }, item) {
       commit("variationsImages/manageImages", item, { root: true });
      state.editedIndex = item.id;
  },

  },
}
