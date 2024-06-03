import { OrderByEnum } from "../../../types/enums/backend/filters/OrderByEnum";
import { StatTypesEnum } from "../../../types/enums/backend/pokemon/StatTypesEnum";
import { Filters } from "../../../types/interfaces/backend/filters/PokemonFilters";
import { StatFilter } from "../../../types/interfaces/backend/filters/SortStat";

interface Props {
    filters: Filters;
    setFilters: Function;
    getAllPokemonWithFilters: Function;
    children: React.ReactNode;
    stat: StatTypesEnum;
}


export function StatsFilter({ children, setFilters, filters, stat, getAllPokemonWithFilters }: Props) {

    const value = filters.sortStat!.find(sortedStat => sortedStat.statName == stat)?.order ?? "";

    const handleChange = (event: React.ChangeEvent<HTMLSelectElement>) => {
        const value = event.target.value;
        const orderBy = OrderByEnum[value.toUpperCase() as keyof typeof OrderByEnum];
        let newFilters = { ...filters }

        if (value === 'none') {
            newFilters.sortStat = newFilters.sortStat?.filter((statFound: StatFilter) => statFound.statName !== stat)
        } else {
            newFilters.sortStat = [...filters.sortStat!, { statName: stat, order: orderBy }];
        }

        setFilters(newFilters);
        getAllPokemonWithFilters();
    };

    return (
        <div className="flex flex-row gap-x-1">
            <label>{children}</label>
            <select onChange={handleChange} value={value}>
                <option value="none">None</option>
                <option value="asc">Asc</option>
                <option value="desc">Desc</option>
            </select>
        </div>
    );
}