import { Filters } from "../backend/filters/PokemonFilters";
import { Pokemon } from "../backend/pokemon/Pokemon";

export interface IPokemonService {
  getAll(filters: Filters): Promise<Pokemon[]>;
  getByIdentifier(identifier: string | number): Promise<Pokemon>;
}
