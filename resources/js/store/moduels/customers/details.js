import toasts from "../../../mixins/toasts";
export default {
    namespaced: true,
    state() {
        return {
            product: {
                category: {
                    id: "",
                    name: "",
                },
            },

            // loading: false,
            activeVariation: {
                selling_price: 0,
                discount_price: 0,
                id: 0,
                big_image: "",
                thumb_image: "",
                stock_qty: 0,
            },

            defaultActiveVariation: {},

            size: {
                id: "",
                name: "",
            },

            defaultSize: {
                id: "",
                name: "",
            },

            color: {
                id: "",
                name: "",
                hex: "",
            },

            defaultColor: {
                id: "",
                name: "",
                hex: "",
            },

            qty: 1,

            variationNotAvailable: false,
        };
    },

    mutations: {
        assignApiData: (state, response) => {
            state.product = Object.assign({}, response.product);
        },

        addDefaultProduct: (state) => {
            state.defaultActiveVariation = {
                big_image: state.product.preview_image,
                small_image: state.product.preview_image,
                color_id: 0,
                size_id: 0,
                id: 404,
                product_id: state.product.id,
                sku: "00000000",
                selling_price: state.product.selling_price,
                discount_price: state.product.discount_price,
                stock_qty: 0,
                stock_ordered: 0,
                status: 0,
            };

            state.product.variations.splice(0, 0, state.defaultActiveVariation);

            state.activeVariation = Object.assign(
                {},
                state.defaultActiveVariation
            );
        },

        resetColorAndSize() {
            state.activeVariation = Object.assign(
                {},
                state.defaultActiveVariation
            );
            state.color = Object.assign({}, state.defaultColor);
            state.size = Object.assign({}, state.defaultSize);
            state.variationNotAvailable = false;
        },

        setDialogValues: (state, dataObject) => {
            if (dataObject.variableType == "qty") {
                state.qty = dataObject.e;
            } else if (dataObject.variableType == "color") {
                state.color = Object.assign({}, dataObject.e);
            } else if (dataObject.variableType == "size") {
                state.size = Object.assign({}, dataObject.e);
            }





            if (state.size.id && state.color.id) {
                let activeVariationIndex = state.product.variations.findIndex(
                    (variation) => {
                        return (
                            variation.color_id === state.color.id &&
                            variation.size_id === state.size.id
                        );
                    }
                );

                if (activeVariationIndex > -1) {
                    state.activeVariation = Object.assign(
                        {},
                        state.product.variations[activeVariationIndex]
                    );

                    state.variationNotAvailable = false;
                } else {
                    state.activeVariation = Object.assign(
                        {},
                        state.defaultActiveVariation
                    );

                    state.activeVariation.id = 401;

                    state.variationNotAvailable = true;
                }
            }
        },

        reset : (state) => {
            setTimeout (() => {
                state.activeVariation = Object.assign({}, state.defaultActiveVariation);
                state.color = Object.assign({}, state.defaultColor);
                state.size = Object.assign({}, state.defaultSize);
              state.qty = 1
            }, 500)

        }
    },

    actions: {


        addToCart({ state  , dispatch}) {
            if (!state.color.id || !state.size.id) {
                toasts.methods.fireWarningToast(
                    "Please choose a color and a size"
                );
            } else {


                if (state.qty <= 0) {
                    toasts.methods.fireWarningToast(
                        "Please choose an items number"
                    );
                }


                else {
                    if (state.variationNotAvailable) {
                        toasts.methods.fireWarningToast(
                            `product with color : <strong> ${state.color.name} </strong >  and size : <strong> ${state.size.name}</strong >    is not available  `
                        );
                    } else {
                        if (state.activeVariation.stock_qty === 0) {
                            toasts.methods.fireWarningToast(
                                "Product is out of stuck"
                            );
                        } else {
                            if (state.activeVariation.stock_qty < state.qty) {
                                toasts.methods.fireWarningToast(
                                    `only ${state.activeVariation.stock_qty} items left`
                                );
                            } else {
                                let formData = new FormData();

                                formData.append("id", state.activeVariation.id);
                                formData.append("product_id", state.activeVariation.id);
                                formData.append("name", state.product.name);
                                formData.append(
                                    "price",
                                    state.activeVariation.discount_price ||
                                        state.activeVariation.selling_price
                                );
                                formData.append("quantity", state.qty);
                                formData.append(
                                    "image",
                                    state.activeVariation.big_image
                                );
                                formData.append("color", state.color.name);
                                formData.append("size", state.size.name);
                                formData.append("sku", state.activeVariation.sku);

                                axios
                                    .post(`/cart`, formData)
                                    .then((response) => {
                                        toasts.methods.fireSuccessToast(
                                            "Product Added to the cart"
                                        );
                                        dispatch("carts/fetch");
                                    })
                                    .catch((error) => {
                                        console.log(error);
                                        alert(error)
                                    });
                            }
                        }
                    }
                }


            }
        },
    },
};
