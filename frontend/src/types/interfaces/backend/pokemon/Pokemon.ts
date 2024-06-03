import { AbilitySlot } from "./AbilitySlot";
import { Move } from "./Move";
import { Stat } from "./Stat";
import { TypeSlot } from "./TypeSlot";

export interface Pokemon {
  id: number;
  name: string;
  game_id: number;
  order: number;
  base_experience: number;
  height: number;
  weight: number;
  stats: Stat[];
  abilities: AbilitySlot[];
  moves: MovesElement[];
  types: TypeSlot[];
}

export interface MovesElement {
  move: Move;
}
