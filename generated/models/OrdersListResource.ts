/* istanbul ignore file */
/* tslint:disable */
/* eslint-disable */

import type { components_schemas_OrderStatusEnum } from './components_schemas_OrderStatusEnum';

export type OrdersListResource = {
    id: number;
    total_price: number;
    status: components_schemas_OrderStatusEnum;
    comment?: string;
    created_at: string;
};

