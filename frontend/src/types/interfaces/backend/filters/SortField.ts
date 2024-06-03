import { FieldTypesEnum } from "@/types/enums/backend/filters/FieldTypesEnum";
import { OrderByEnum } from "@/types/enums/backend/filters/OrderByEnum";

export interface SortField {
  name: FieldTypesEnum;
  order: OrderByEnum;
}
