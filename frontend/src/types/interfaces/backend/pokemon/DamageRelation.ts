import { TypeEnum } from "../../../../types/enums/backend/pokemon/TypeEnum";
import { DamageRelationTypesEnum } from "../../../enums/backend/pokemon/DamageRelationTypesEnum";

export interface DamageRelation {
  damage_relation_type: DamageRelationTypesEnum;
  to_type: TypeEnum;
}
