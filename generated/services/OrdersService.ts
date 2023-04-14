/* istanbul ignore file */
/* tslint:disable */
/* eslint-disable */
import type { components_schemas_OrderStatusEnum } from '../models/components_schemas_OrderStatusEnum';
import type { OrdersListResource } from '../models/OrdersListResource';
import type { StoreOrderRequest } from '../models/StoreOrderRequest';

import type { CancelablePromise } from '../core/CancelablePromise';
import { OpenAPI } from '../core/OpenAPI';
import { request as __request } from '../core/request';

export class OrdersService {

    /**
     * Get orders list
     * Return orders list
     * @param status Статус заказа
     * @param page Номер страницы
     * @returns OrdersListResource The data
     * @throws ApiError
     */
    public static cd7E03021E72D9D799C12Dfe179C865(
        status?: components_schemas_OrderStatusEnum,
        page?: number,
    ): CancelablePromise<Array<OrdersListResource>> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/orders',
            query: {
                'status': status,
                'page': page,
            },
            errors: {
                401: `Unauthorized`,
            },
        });
    }

    /**
     * Create new order
     * Return new order
     * @param requestBody
     * @returns OrdersListResource The data
     * @throws ApiError
     */
    public static d690D6834318E9B064Df441E854De8B9(
        requestBody?: StoreOrderRequest,
    ): CancelablePromise<OrdersListResource> {
        return __request(OpenAPI, {
            method: 'POST',
            url: '/api/orders',
            body: requestBody,
            mediaType: 'application/json',
            errors: {
                401: `Unauthorized`,
            },
        });
    }

    /**
     * Get orders
     * Return order
     * @param order ID заказа
     * @returns OrdersListResource The data
     * @throws ApiError
     */
    public static f090F23952A43521Af6F1D133826Bc37(
        order: number,
    ): CancelablePromise<OrdersListResource> {
        return __request(OpenAPI, {
            method: 'GET',
            url: '/api/orders/{order}',
            path: {
                'order': order,
            },
            errors: {
                401: `Unauthorized`,
                404: `Order not found`,
            },
        });
    }

    /**
     * Cancel orders
     * Cancel order
     * @param order ID заказа
     * @returns any The data
     * @throws ApiError
     */
    public static eaa440967Db2292Bbfa757F6Fc6F44(
        order: number,
    ): CancelablePromise<Record<string, any>> {
        return __request(OpenAPI, {
            method: 'DELETE',
            url: '/api/orders/{order}',
            path: {
                'order': order,
            },
            errors: {
                401: `Unauthorized`,
                404: `Order not found`,
            },
        });
    }

}
