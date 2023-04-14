/* istanbul ignore file */
/* tslint:disable */
/* eslint-disable */
import type { AddProductToCartRequest } from '../models/AddProductToCartRequest';
import type { CartProductsResource } from '../models/CartProductsResource';
import type { SuccessResponse } from '../models/SuccessResponse';

import type { CancelablePromise } from '../core/CancelablePromise';
import { OpenAPI } from '../core/OpenAPI';
import { request as __request } from '../core/request';

export class CartService {

    /**
     * Get products list in cart
     * Return products list in cart
     * @returns CartProductsResource The data
     * @throws ApiError
     */
    public static f94Dde92E36Bbb3C461356Ce1D7B(): CancelablePromise<Array<CartProductsResource>> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/cart',
            errors: {
                401: `Unauthorized`,
            },
        });
    }

    /**
     * Add product in cart
     * Add product in cart
     * @param requestBody
     * @returns SuccessResponse The data
     * @throws ApiError
     */
    public static a79408Fcd7145629Ecfb61694Ae189Af(
        requestBody?: AddProductToCartRequest,
    ): CancelablePromise<SuccessResponse> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/cart',
            body: requestBody,
            mediaType: 'application/json',
            errors: {
                404: `Product not found`,
            },
        });
    }

    /**
     * Remove product from cart
     * Remove product from cart
     * @param product ID товара
     * @returns SuccessResponse The data
     * @throws ApiError
     */
    public static a6367913Aadd06Beb7Bb4A9Eff2Ce29(
        product: number,
    ): CancelablePromise<SuccessResponse> {
        return __request(OpenAPI, {
            method: 'DELETE',
            url: '/api/cart/{product}',
            path: {
                'product': product,
            },
            errors: {
                404: `Product not found`,
            },
        });
    }

}
