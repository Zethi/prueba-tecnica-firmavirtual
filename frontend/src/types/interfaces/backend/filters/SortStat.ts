import { OrderByEnum } from "../../../../types/enums/backend/filters/OrderByEnum";
import { StatTypesEnum } from "../../../../types/enums/backend/pokemon/StatTypesEnum";

export interface StatFilter {
  statName: StatTypesEnum;
  order: OrderByEnum;
}
