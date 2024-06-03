import { TypeEnum } from "@/types/enums/backend/pokemon/TypeEnum";

export interface Move {
  name: string;
  pp: number;
  power: number;
  priority: number;
  accuracy: number;
  type: {
    name: TypeEnum;
  };
}
