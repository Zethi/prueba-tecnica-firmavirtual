import { TypeEnum } from "../../../../types/enums/backend/pokemon/TypeEnum";
import { StatFilter } from "./SortStat";
import { SortField } from "./SortField";

export interface Filters {
  limit?: number;
  nameLike?: string;
  fields?: SortField[];
  type?: TypeEnum[];
  sortStat?: StatFilter[];
}
