#!/bin/bash

es_data_folder=$(docker volume inspect --format '{{ .Mountpoint }}' social-network-analysis_es-data)
kibana_data_folder=$(docker volume inspect --format '{{ .Mountpoint }}' social-network-analysis_kibana-data)
kibana_config_folder=$(docker volume inspect --format '{{ .Mountpoint }}' social-network-analysis_kibana-config)
root_script_dir=${PWD}

# Backup docker volumes from elasticsearch and kibana into resources folder
tar -cvf "${root_script_dir}"/elasticsearch/es-data.tar -C "${es_data_folder}" .
tar -cvf "${root_script_dir}"/kibana/kibana-data.tar -C "${kibana_data_folder}" .
tar -cvf "${root_script_dir}"/kibana/kibana-config.tar -C "${kibana_config_folder}" .
