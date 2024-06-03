import { Filters } from "../../../types/interfaces/backend/filters/PokemonFilters";
import { DropDown } from "../Dropdown/Dropdown";
import { TypesFilter } from "./TypesFilter";
import { TypeEnum } from "../../../types/enums/backend/pokemon/TypeEnum";
import PokemonType from "../PokemonType/PokemonType";
import { StatTypesEnum } from "../../../types/enums/backend/pokemon/StatTypesEnum";
import { StatsFilter } from "./StatsFilter";
import { PokemonStatNamesDictionary } from "../../../types/dictionarys/PokemonStatNamesDictionary";
import { FieldTypesEnum } from "../../../types/enums/backend/filters/FieldTypesEnum";
import { FieldsFilter } from "./FieldsFilter";

interface Props {
    filters: Filters;
    setFilters: Function;
    getAllPokemonWithFilters: Function;
}

export function FiltersDropdown({ filters, setFilters, getAllPokemonWithFilters }: Props) {
    return (
        <DropDown title="Filters">
            <div className="">
                <div>
                    <span>Filters By Fields</span>
                    <div className="flex flex-row flex-wrap gap-x-2 gap-y-1 mb-4 mt-2">
                        {Object.keys(FieldTypesEnum).map((fieldKey) => {
                            const field = FieldTypesEnum[fieldKey as keyof typeof FieldTypesEnum];

                            return (
                                <FieldsFilter key={`filter-field-${field}`} filters={filters} setFilters={setFilters} getAllPokemonWithFilters={getAllPokemonWithFilters} field={field}>
                                    {field}
                                </FieldsFilter>
                            )
                        })}
                    </div>
                </div>

                <div>
                    <span>Filters By Stats</span>
                    <div className="flex flex-row flex-wrap gap-x-2 gap-y-1 mb-4 mt-2">
                        {Object.keys(StatTypesEnum).map((statKey) => {
                            const stat = StatTypesEnum[statKey as keyof typeof StatTypesEnum];

                            return (
                                <StatsFilter key={`filter-stat-${stat}`} filters={filters} setFilters={setFilters} getAllPokemonWithFilters={getAllPokemonWithFilters} stat={stat}>
                                    {PokemonStatNamesDictionary[stat]}
                                </StatsFilter>
                            )
                        })}
                    </div>
                </div>
                <hr />
                <div className="mt-4">
                    <span>Filters By Type</span>
                    <div className="flex flex-row flex-wrap gap-x-2 gap-y-1 mt-2">
                        {Object.keys(TypeEnum).map((typeKey) => {
                            const type = TypeEnum[typeKey as keyof typeof TypeEnum];

                            return (
                                <TypesFilter key={`filter-type-${type}`} filters={filters} setFilters={setFilters} getAllPokemonWithFilters={getAllPokemonWithFilters} type={type}>
                                    <PokemonType pokemonType={type} />
                                </TypesFilter>
                            )
                        })}
                    </div>

                </div>

            </div>
        </DropDown >
    )
}