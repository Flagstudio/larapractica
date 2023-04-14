/* istanbul ignore file */
/* tslint:disable */
/* eslint-disable */
import type { ProductsResource } from '../models/ProductsResource';
import type { SuccessResponse } from '../models/SuccessResponse';

import type { CancelablePromise } from '../core/CancelablePromise';
import { OpenAPI } from '../core/OpenAPI';
import { request as __request } from '../core/request';

export class CategoryService {

    /**
     * Get categories list
     * Return categories list
     * @param page Номер страницы
     * @returns SuccessResponse The data
     * @throws ApiError
     */
    public static f5817A34833D0A1F4Af4548Dd3Aeaba(
        page?: number,
    ): CancelablePromise<SuccessResponse> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/categories',
            query: {
                'page': page,
            },
        });
    }

    /**
     * Get the category
     * Return the category
     * @param category ID категории
     * @returns SuccessResponse The data
     * @throws ApiError
     */
    public static e92579E78391B6199E78C2A091Dbea0A(
        category: number,
    ): CancelablePromise<SuccessResponse> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/categories/{category}',
            path: {
                'category': category,
            },
            errors: {
                404: `Category not found`,
            },
        });
    }

    /**
     * Get products list of category
     * Return products list of category
     * @param category ID категории
     * @param page Номер страницы
     * @returns ProductsResource The data
     * @throws ApiError
     */
    public static d537A60Aa81566D618376F0Ade1(
        category: number,
        page?: number,
    ): CancelablePromise<Array<ProductsResource>> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/categories/{category}/products',
            path: {
                'category': category,
            },
            query: {
                'page': page,
            },
            errors: {
                404: `Category not found`,
            },
        });
    }

    /**
     * Get products list of category
     * Return products list of category
     * @param category ID категории
     * @param product ID товара
     * @returns ProductsResource The data
     * @throws ApiError
     */
    public static a1C39428218E503Ca55A0B757770050D(
        category: number,
        product: number,
    ): CancelablePromise<ProductsResource> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/categories/{category}/products/{product}',
            path: {
                'category': category,
                'product': product,
            },
            errors: {
                404: `Not found`,
            },
        });
    }

}
