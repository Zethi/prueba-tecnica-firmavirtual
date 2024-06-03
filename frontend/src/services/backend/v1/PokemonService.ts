import { Filters } from "../../../types/interfaces/backend/filters/PokemonFilters";
import { SortField } from "../../../types/interfaces/backend/filters/SortField";
import { StatFilter } from "../../../types/interfaces/backend/filters/SortStat";
import { Pokemon } from "../../../types/interfaces/backend/pokemon/Pokemon";
import { IPokemonService } from "../../../types/interfaces/services/IPokemonServices";
import { capitalizeFirstLetter } from "../../../utils/StringUtils";
import axios from "axios";

export class PokemonService implements IPokemonService {
  private BACKEND_URL = process.env.BACKEND_URL ?? "http://127.0.0.1:8000/api";

  async getAll(filters: Filters): Promise<Pokemon[]> {
    const params = new URLSearchParams();
    let types: string[] = [];

    Object.entries(filters).forEach(([key, value]) => {
      if (key === "type" && Array.isArray(value)) {
        params.append("type", value.join(","));
      } else if (key === "sortStat") {
        (value as StatFilter[]).forEach((statFilter) => {
          params.append("stats", `${statFilter.statName}:${statFilter.order}`);
        });
      } else if (key === "fields") {
        (value as SortField[]).forEach((fieldFilter) => {
          console.log(fieldFilter.name);
          console.log(fieldFilter.order);
          params.append(
            `sortBy${capitalizeFirstLetter(fieldFilter.name.toString())}`,
            `${fieldFilter.order}`
          );
        });
      } else {
        params.append(key, value.toString());
      }
    });

    const url = `${this.BACKEND_URL}/v1/pokemon?${params.toString()}`;
    const response = await axios.get(url);

    return response.data.data;
  }

  async getByIdentifier(identifier: string | number): Promise<Pokemon> {
    const pokemon = (
      await axios.get(this.BACKEND_URL + `/v1/pokemon/${identifier}`)
    ).data;

    return pokemon;
  }
}
