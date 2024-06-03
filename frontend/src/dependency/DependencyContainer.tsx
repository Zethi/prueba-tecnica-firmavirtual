import { PokemonService } from "@/services/backend/v1/PokemonService";
import { IPokemonService } from "@/types/interfaces/services/IPokemonServices";

type Constructor<T> = new (...args: any[]) => T;

export class DependencyContainer {
    private services = new Map<string, any>();

    register<T>(interfaceName: string, service: Constructor<T>) {
        this.services.set(interfaceName, new service());
    }

    resolve<T>(interfaceName: string): T {
        const service = this.services.get(interfaceName);
        if (!service) {
            throw new Error(`Service ${interfaceName} not found`);
        }
        return service;
    }
}

const container = new DependencyContainer();

container.register<IPokemonService>('IPokemonService', PokemonService);

export default container;