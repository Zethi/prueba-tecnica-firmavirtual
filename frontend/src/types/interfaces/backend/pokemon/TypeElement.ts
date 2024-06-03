import { TypeEnum } from "../../../../types/enums/backend/pokemon/TypeEnum";
import { DamageRelation } from "./DamageRelation";

export interface TypeElement {
  name: TypeEnum;
  damage_relations: DamageRelation[];
}
