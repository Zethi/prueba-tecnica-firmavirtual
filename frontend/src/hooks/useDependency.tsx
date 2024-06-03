'use client';

import { useContext, createContext } from 'react';
import container from '../dependency/DependencyContainer';

const DependencyContext = createContext(container);

export const DependencyProvider = ({ children }: { children: React.ReactNode }) => {
    return (
        <DependencyContext.Provider value={container}>
            {children}
        </DependencyContext.Provider>
    );
};

export const useDependency = <T,>(interfaceName: string): T => {
    const context = useContext(DependencyContext);
    if (!context) {
        throw new Error('useDependency must be used within a DependencyProvider');
    }
    return context.resolve<T>(interfaceName);
};